<?php

namespace App\Services\Claim;

use App\Crud\Inheritance\Inheritance;
use App\Crud\InheritanceAwareInterface;
use App\Crud\InheritanceAwareTrait;
use App\Entities\Claim\Item as Claim;
use App\Entities\Claim\State;
use App\Entities\User\UserAbstract;
use App\Repositories\Claim\Claim as ClaimRepository;
use App\Repositories\Exception\EntityNotFound;
use App\Services\Claim\Strategy\Admin;
use App\Services\Claim\Strategy\Homeowner;
use App\Services\Claim\Strategy\Professional;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class ClaimService
 *
 * @package App\Services\Claim
 * @method Inheritance getInheritanceResolver()
 */
class ClaimService implements InheritanceAwareInterface
{
    use InheritanceAwareTrait;

    /**
     * @var ClaimRepository
     */
    private $repository;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(Claim::class);
        $this->userService = app(UserService::class);
    }

    /**
     * @return Claim
     */
    public function createEmptyEntity()
    {
        return new Claim();
    }

    /**
     * @param int $perPage
     * @param string $pageName
     *
     * @return LengthAwarePaginator
     */
    public function getList($perPage = 15, $pageName = 'page')
    {
        /** @var \App\Services\Claim\Strategy\ClaimAbstract $strategy */
        $strategy = $this->getInheritanceResolver()->getStrategy(Auth::user()->type);

        return $strategy->getAll($perPage, $pageName);
    }

    /**
     * @param int $itemId
     *
     * @return object|null
     */
    public function get($itemId)
    {
        return $this->repository->find($itemId);
    }

    /**
     * @param int $itemId
     */
    public function delete($itemId)
    {
        return $this->repository->delete($itemId);
    }

    /**
     * @param Request $request
     *
     * @return Claim
     */
    public function create(Request $request)
    {
        /** @var UserAbstract $user */
        $user = $this->userService->find(Auth::id());
        $user->setSubscription($request->get('subscription', 0));

        $entity = $this->createEmptyEntity();
        $entity->setZipcode($request->get('zipcode'))
            ->setProvider($request->get('provider'))
            ->setProperty($request->get('property'))
            ->setDamages($request->get('damages'))
            ->setState(State::createFromScalar($request->get('state')))
            ->setText($request->get('text'))
            ->setUser($user);
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }

    /**
     * @param Request $request
     *
     * @return object|null
     */
    public function update(Request $request)
    {
        try {
            /** @var Claim $entity */
            $entity = $this->repository->find($request->get('itemId'));
        } catch (\Exception $exception) {
            throw new EntityNotFound(
                sprintf('Item with id "%s" was not find', $request->get('itemId')),
                $exception->getCode(),
                $exception
            );
        }

        if ($request->has('professional')) {
            $entity->setProfessional(
                $this->userService->find($request->get('professional'))
            );
        }

        $entity->setZipcode($request->get('zipcode'))
            ->setProvider($request->get('provider'))
            ->setProperty($request->get('property'))
            ->setDamages($request->get('damages'))
            ->setState(State::createFromScalar($request->get('state')))
            ->setText($request->get('text'));
        $entity->getUser()->setSubscription($request->get('subscription', 0));
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }

    /**
     * @inheritDoc
     */
    public function getDiscriminatorName()
    {
        return 'type';
    }

    /**
     * @inheritDoc
     */
    public function getServicesNames()
    {
        return [
            UserService::TYPE_ADMIN => Admin::class,
            UserService::TYPE_HOMEOWNER => Homeowner::class,
            UserService::TYPE_PROFESSIONAL => Professional::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getBaseEntityName()
    {
        return Claim::class;
    }
}
