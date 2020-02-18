<?php

namespace App\Services\User;

use App\Crud\CrudInterface;
use App\Crud\CrudTrait;
use App\Crud\Inheritance\Inheritance;
use App\Crud\InheritanceAwareInterface;
use App\Crud\InheritanceAwareTrait;
use App\Entities\User\UserAbstract;
use App\Services\User\Strategy\Admin;
use App\Services\User\Strategy\Homeowner;
use App\Services\User\Strategy\Professional;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class UserService
 *
 * @package App\Services\User
 * @method Inheritance getInheritanceResolver()
 */
class UserService implements CrudInterface, InheritanceAwareInterface
{
    use CrudTrait;
    use InheritanceAwareTrait;

    const TYPE_ADMIN = 'admin';
    const TYPE_HOMEOWNER = 'homeowner';
    const TYPE_PROFESSIONAL = 'professional';

    /**
     * @var \App\Repositories\User\Users
     */
    private $repository;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(UserAbstract::class);
    }

    /**
     * @return UserAbstract
     *
     * @throws \Exception
     */
    public function createNew(array $data)
    {
        $descriminator = $data['type'];
        unset($data['type']);
        $data['subscription'] = array_get($data, 'subscription', false);
        /** @var \App\Services\User\Strategy\UserAbstract $strategy */
        $strategy = $this->getInheritanceResolver()->getStrategy($descriminator);

        return $strategy->createNew($data);
    }

    /**
     * @param string $type
     *
     * @return UserAbstract[]|null
     */
    public function getListByType($type)
    {
        /** @var \App\Services\User\Strategy\UserAbstract $strategy */
        $strategy = $this->getInheritanceResolver()->getStrategy($type);

        return $strategy->getAll();
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
     * @return array|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function get($itemId)
    {
        $queryBuilder = EntityManager::createQueryBuilder();
        $data = $queryBuilder->select('p')
            ->from(UserAbstract::class, 'p')
            ->where('p.id= :id')
            ->setParameter('id', $itemId)
            ->getQuery()
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        return $data;
    }

    /**
     * @param object $socialUser
     *
     * @return UserAbstract|null
     */
    public function getOrCreate(object $socialUser)
    {
        $user = User::whereEmail($socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'type' => self::TYPE_HOMEOWNER,
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName(),
                'password' => Hash::make('secret'),
            ]);
        }

        return $user;
    }

    /**
     * @param array $data
     *
     * @param bool $flush
     * @param array $context
     * @param string $permission
     *
     * @return object
     * @throws \Exception
     */
    public function create(array $data, $flush = true, array $context = [], $permission = __FUNCTION__)
    {
        EntityManager::beginTransaction();
        $context['identity'] = '';
        try {
            $entity = $this->getInheritanceResolver()->create($data, $flush, $context, $permission);
            EntityManager::commit();
        } catch (\Exception $exception) {
            EntityManager::rollback();
            throw $exception;
        }

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
            self::TYPE_ADMIN => Admin::class,
            self::TYPE_HOMEOWNER => Homeowner::class,
            self::TYPE_PROFESSIONAL => Professional::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getBaseEntityName()
    {
        return UserAbstract::class;
    }
}
