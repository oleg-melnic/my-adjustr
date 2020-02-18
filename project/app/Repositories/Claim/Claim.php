<?php

namespace App\Repositories\Claim;

use App\Repositories\Exception\DeletionFailed;
use Doctrine\ORM\EntityRepository;
use LaravelDoctrine\ORM\Pagination\PaginatesFromRequest;

class Claim extends EntityRepository
{
    use PaginatesFromRequest;

    /**
     * @return array|mixed
     */
    public function findAll()
    {
        $queryBuilder = $this->createQueryBuilder('q');

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
