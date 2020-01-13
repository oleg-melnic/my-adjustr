<?php

namespace App\Repositories\Faq;

use App\Repositories\Exception\DeletionFailed;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class Question extends EntityRepository
{
    use PaginatesFromRequest;

    /**
     * @param string $alias
     *
     * @return \App\Entities\Faq\Category | null
     *
     * @throws NonUniqueResultException
     */
    public function findOneByAlias($alias)
    {
        $queryBuilder = $this->createQueryBuilder('q')
            ->where('q.alias = :alias')
            ->setParameter('alias', $alias);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array|mixed
     */
    public function findAll()
    {
        $queryBuilder = $this->createQueryBuilder('q')
            ->orderBy('q.position', 'ASC');

        return $queryBuilder->getQuery()->getResult();
    }

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

    public function paginateAllItems($perPage = 15, $pageName = 'page')
    {
        return $this->paginateAll($perPage, $pageName);
    }

    /**
     * @param int $questionId
     */
    public function delete($questionId)
    {
        try {
            $entity = $this->find($questionId);
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Exception $exception) {
            throw new DeletionFailed(
                sprintf('Item with id "%s" was not find', $questionId),
                $exception->getCode(),
                $exception
            );
        }
    }
}
