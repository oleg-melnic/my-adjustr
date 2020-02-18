<?php

namespace App\Services\Claim\Strategy;

use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class Homeowner
 */
class Homeowner extends ClaimAbstract
{
    /**
     * @var \App\Repositories\Claim\Homeowner
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(\App\Entities\Claim\Homeowner::class);
    }

    /**
     * @param int $perPage
     * @param string $pageName
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll($perPage = 15, $pageName = 'page')
    {
        return $this->repository->paginateAllItems($perPage, $pageName);
    }
}
