<?php

namespace App\Repositories\Blog;

use App\Repositories\Exception\DeletionFailed;
use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class Post extends EntityRepository
{
    use PaginatesFromRequest;

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
     * @param int $itemId
     */
    public function delete($itemId)
    {
        try {
            $entity = $this->find($itemId);
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        } catch (\Exception $exception) {
            throw new DeletionFailed(
                sprintf('Item with id "%s" was not find', $itemId),
                $exception->getCode(),
                $exception
            );
        }
    }
}
