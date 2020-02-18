<?php

namespace App\Entities\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homeowner
 * @ORM\Entity
 */
class Homeowner extends UserAbstract
{
    /**
     * Get a list of role names
     *
     * @return array
     */
    protected function getRoleNames()
    {
        return ['homeowner'];
    }
}
