<?php

namespace App\Services;

use App\Entities\Faq\Category;
use App\Entities\Faq\Question as QuestionEntity;
use App\Repositories\Exception\EntityNotFound;
use App\Repositories\Faq\Question;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class FaqService
{
    /**
     * @var Question
     */
    private $repository;

    /**
     * @var FaqCategoryService
     */
    private $categoryService;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(QuestionEntity::class);
        $this->categoryService = app(FaqCategoryService::class);
    }

    /**
     * @return QuestionEntity
     */
    public function createEmptyEntity()
    {
        return new QuestionEntity();
    }

    /**
     * @return array
     */
    public function getList()
    {
        $result = [];

        /** @var Category $category */
        foreach ($this->categoryService->getList() as $category) {
            $result[$category->getIdentity()] = [
                'title' => $category->getTitle(),
                'alias' => $category->getAlias(),
                'items' => $this->repository->findBy(['category' => $category]),
            ];
        }

        return $result;
    }

    /**
     * @param Category $category
     *
     * @return array|object[]
     */
    public function getByCategory(Category $category)
    {
        return $this->repository->findBy(['category' => $category]);
    }

    /**
     * @param int $questionId
     *
     * @return object|null
     */
    public function get($questionId)
    {
        return $this->repository->find($questionId);
    }

    /**
     * @param int $questionId
     */
    public function delete($questionId)
    {
        return $this->repository->delete($questionId);
    }

    /**
     * @param Request $request
     *
     * @return QuestionEntity
     */
    public function create(Request $request)
    {
        $entity = $this->createEmptyEntity();
        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setCategory($this->categoryService->get($request->get('category')))
            ->setPosition(0)
            ->setAnswer($request->get('answer'));
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
            $entity = $this->repository->find($request->get('questionId'));
        } catch (\Exception $exception) {
            throw new EntityNotFound(
                sprintf('Item with id "%s" was not find', $request->get('questionId')),
                $exception->getCode(),
                $exception
            );
        }

        $entity->setAlias($request->get('alias'))
            ->setLockAlias($request->get('lockalias'))
            ->setTitle($request->get('title'))
            ->setCategory($this->categoryService->get($request->get('category')))
            ->setAnswer($request->get('answer'));
        EntityManager::persist($entity);
        EntityManager::flush();

        return $entity;
    }
}
