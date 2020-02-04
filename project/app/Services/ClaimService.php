<?php

namespace App\Services;

use App\Entities\Claim\Item as Claim;
use App\Entities\Claim\State;
use App\Entities\Users;
use App\Repositories\Claim as ClaimRepository;
use App\Repositories\Exception\EntityNotFound;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ClaimService
{
    /**
     * @var ClaimRepository
     */
    private $repository;

    /**
     * @var UsersService
     */
    private $userService;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(Claim::class);
        $this->userService = app(UsersService::class);
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
        return $this->repository->paginateAllItems($perPage, $pageName);
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
        /** @var Users $user */
        $user = $this->userService->get(Auth::id());
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
}
