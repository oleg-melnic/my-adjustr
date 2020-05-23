<?php

namespace App\Services;

use App\Entities\Faq\Category;
use App\Repositories\Exception\EntityNotFound;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Facades\EntityManager;

class FaqCategoryService
{
    /**
     * @var \App\Repositories\Faq\Category
     */
    private $repository;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(Category::class);
    }

    /**
     * @return Category
     */
    public function createEmptyEntity()
    {
        return new Category();
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
     * @param int $categoryId
     *
     * @return object|null
     */
    public function get($categoryId)
    {
        return $this->repository->find($categoryId);
    }

    /**
     * @param string $alias
     *
     * @return Category|object|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByAlias($alias)
    {
        return $this->repository->findOneByAlias($alias);
    }

    /**
     * @param int $categoryId
     */
    public function delete($categoryId)
    {
        return $this->repository->delete($categoryId);
    }

    /**
     * @param Request $request
     *
     * @return Category
     */
    public function create(Request $request)
    {
        $entity = $this->createEmptyEntity();
        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setText($request->get('text'))
            ->setSeoTitle($request->get('seo_title'))
            ->setSeoKeywords($request->get('seo_keywords'))
            ->setSeoDescription($request->get('seo_description'));
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
            $entity = $this->repository->find($request->get('categoryId'));
        } catch (\Exception $exception) {
            throw new EntityNotFound(
                sprintf('Item with id "%s" was not find', $request->get('categoryId')),
                $exception->getCode(),
                $exception
            );
        }

        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setText($request->get('text'))
            ->setSeoTitle($request->get('seo_title'))
            ->setSeoKeywords($request->get('seo_keywords'))
            ->setSeoDescription($request->get('seo_description'));
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }
}
