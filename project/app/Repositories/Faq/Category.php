<?php

namespace App\Repositories\Faq;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

class Category extends EntityRepository
{
    /**
     * @param string $alias
     *
     * @return \App\Entities\Faq\Category | null
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
