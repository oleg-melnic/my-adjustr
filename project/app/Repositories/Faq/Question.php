<?php

namespace App\Repositories\Faq;

use Doctrine\ORM\EntityRepository;

class Question extends EntityRepository
{
    /**
     * @param \DateTime $from - Дата с
     * @param \DateTime $toInterval - Дата до
     * @return array
     */
    public function findByInterval(\DateTime $from, \DateTime $toInterval)
    {
        $queryBuilder = $this->createQueryBuilder('q')
            ->where('q.createDate >= :from')
            ->andWhere('q.createDate <= :toInterval')
            ->setParameters(
                array(
                    'from' => $from->format('Y-m-d').' 00:00:00',
                    'toInterval' => $toInterval->format('Y-m-d').' 23:59:59'
                )
            )
            ->orderBy('q.position', 'ASC')
            ->setMaxResults(10);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function findByIDs($ids)
    {
        $queryBuilder = $this->createQueryBuilder('q')
             ->where('q.identity IN (:ids)')
             ->setParameters(['ids' => $ids]);

        return $queryBuilder->getQuery()->getResult();
    }
}
