<?php

namespace App\Repositories\Blog;

use App\Repositories\Exception\DeletionFailed;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class Category extends EntityRepository
{
    use PaginatesFromRequest;

    /**
     * @param string $alias
     *
     * @return \App\Entities\Blog\Category | null
     *
     * @throws NonUniqueResultException
     */
    public function findOneByAlias($alias)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->where('c.alias = :alias')
            ->setParameter('alias', $alias);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array|mixed
     */
    public function findAll()
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->orderBy('c.position', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $perPage
     * @param string $pageName
     *
     * @return LengthAwarePaginator
     */
    public function paginateAllItems($perPage = 15, $pageName = 'page')
    {
        return $this->paginateAll($perPage, $pageName);
    }

    /**
     * @param int $categoryId
     */
    public function delete($categoryId)
    {
        try {
            $entity = $this->find($categoryId);
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Exception $exception) {
            throw new DeletionFailed(
                sprintf('Item with id "%s" was not find', $categoryId),
                $exception->getCode(),
                $exception
            );
        }
    }
}
