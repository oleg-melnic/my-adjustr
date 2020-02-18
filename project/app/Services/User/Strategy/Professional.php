<?php

namespace App\Services\User\Strategy;

use App\Services\User\UserService;

/**
 * Class Professional
 *
 * @method \App\Repositories\User\Professional getRepository()
 */
class Professional extends UserAbstract
{
    /**
     * @return string
     */
    public function getBaseEntityName()
    {
        return \App\Entities\User\Professional::class;
    }

    /**
     * @param array $data
     *
     * @return \App\Entities\User\Professional
     */
    public function createEmptyEntity(array $data)
    {
        return new \App\Entities\User\Professional();
    }

    /**
     * @return \App\Entities\User\Professional[]|null
     *
     */
    public function getAll()
    {
        return $this->getRepository()->findAll(
            [
                'type' => UserService::TYPE_PROFESSIONAL,
            ]
        );
    }
}
