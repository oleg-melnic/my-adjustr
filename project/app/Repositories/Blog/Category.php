<?php

namespace App\Repositories\Blog;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class Category extends EntityRepository
{
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
}
