<?php

namespace App\Services\Blog;

use App\Entities\Blog\Post;
use App\Entities\Blog\State;
use App\Repositories\Blog\Post as PostRepository;
use App\Repositories\Exception\EntityNotFound;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Facades\EntityManager;

class Service
{
    /**
     * @var PostRepository
     */
    private $repository;

    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(Post::class);
        $this->categoryService = app(CategoryService::class);
    }

    /**
     * @return Post
     */
    public function createEmptyEntity()
    {
        return new Post();
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
     * @return Post
     */
    public function create(Request $request)
    {
        $entity = $this->createEmptyEntity();
        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setCategory($this->categoryService->get($request->get('category')))
            ->setText($request->get('text'))
            ->setState(State::createFromScalar(State::ACTIVE));
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
            /** @var Post $entity */
            $entity = $this->repository->find($request->get('postId'));
        } catch (\Exception $exception) {
            throw new EntityNotFound(
                sprintf('Item with id "%s" was not find', $request->get('postId')),
                $exception->getCode(),
                $exception
            );
        }

        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setCategory($this->categoryService->get($request->get('category')))
            ->setText($request->get('text'))
            ->setState(State::createFromScalar($request->get('state', State::ACTIVE)));
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }
}
