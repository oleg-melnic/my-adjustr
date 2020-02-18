<?php

namespace App\Services\User\Strategy;

use App\Services\User\UserService;

/**
 * Class Admin
 *
 * @method \App\Repositories\User\Admin getRepository()
 */
class Admin extends UserAbstract
{
    /**
     * @return string
     */
    public function getBaseEntityName()
    {
        return \App\Entities\User\Admin::class;
    }

    /**
     * @param array $data
     *
     * @return \App\Entities\User\Admin
     */
    public function createEmptyEntity(array $data)
    {
        return new \App\Entities\User\Admin();
    }

    /**
     * @return \App\Entities\User\Admin[]|null
     *
     */
    public function getAll()
    {
        return $this->getRepository()->findAll(
            [
                'type' => UserService::TYPE_ADMIN,
            ]
        );
    }
}
