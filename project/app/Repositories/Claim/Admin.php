<?php

namespace App\Repositories\Claim;

use App\Entities\Claim\Item;

/**
 * Class Admin
 *
 * @package App\Repositories\Claim
 */
class Admin extends Claim
{
    /**
     * @param int    $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginateAllItems($perPage = 15, $pageName = 'page')
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder()->select('c')
            ->from(Item::class, 'c')
            ->getQuery();

        return $this->paginate($query, $perPage, $pageName, false);
    }
}
