<?php

namespace App\Services\Claim\Strategy;

use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class Admin
 */
class Admin extends ClaimAbstract
{
    /**
     * @var \App\Repositories\Claim\Admin
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = EntityManager::getRepository(\App\Entities\Claim\Admin::class);
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
