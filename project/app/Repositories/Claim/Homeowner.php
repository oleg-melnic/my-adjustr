<?php

namespace App\Repositories\Claim;

use App\Entities\Claim\Item;
use Illuminate\Support\Facades\Auth;

/**
 * Class Homeowner
 *
 * @package App\Repositories\Claim
 */
class Homeowner extends Claim
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
            ->where('c.user = :user')
            ->setParameter('user', Auth::id())
            ->getQuery();

        return $this->paginate($query, $perPage, $pageName, false);
    }
}
