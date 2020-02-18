<?php

namespace App\Services\User\Strategy;

use App\Services\User\UserService;

/**
 * Class Homeowner
 *
 * @method \App\Repositories\User\Homeowner getRepository()
 */
class Homeowner extends UserAbstract
{
    /**
     * @return string
     */
    public function getBaseEntityName()
    {
        return \App\Entities\User\Homeowner::class;
    }

    /**
     * @param array $data
     *
     * @return \App\Entities\User\Homeowner
     */
    public function createEmptyEntity(array $data)
    {
        return new \App\Entities\User\Homeowner();
    }

    /**
     * @return \App\Entities\User\Homeowner[]|null
     *
     */
    public function getAll()
    {
        return $this->getRepository()->findAll(
            [
                'type' => UserService::TYPE_HOMEOWNER,
            ]
        );
    }
}
