<?php

namespace App\Services;

use App\Entities\Users;
use App\Repositories\Exception\EntityNotFound;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use LaravelDoctrine\ORM\Facades\EntityManager;

class UsersService
{
    /**
     * @var \App\Repositories\Users
     */
    private $repository;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(Users::class);
    }

    /**
     * @return Users
     */
    public function createEmptyEntity()
    {
        return new Users();
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
     * @param array $data
     *
     * @return Users
     */
    public function create(array $data)
    {
        $entity = $this->createEmptyEntity();
        $entity->setName(array_get($data, 'name'))
            ->setEmail(array_get($data, 'email'))
            ->setPassword(Hash::make(array_get($data, 'password')));
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
            /** @var Users $entity */
            $entity = $this->repository->find($request->get('itemId'));
        } catch (\Exception $exception) {
            throw new EntityNotFound(
                sprintf('Item with id "%s" was not find', $request->get('itemId')),
                $exception->getCode(),
                $exception
            );
        }

        $entity->setName($request->get('name'))
            ->setEmail($request->get('email'))
            ->setPassword(Hash::make($request->get('password')));
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }
}
