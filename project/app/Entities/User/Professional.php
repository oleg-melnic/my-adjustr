<?php

namespace App\Entities\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professional
 * @ORM\Entity
 */
class Professional extends UserAbstract
{
    /**
     * Get a list of role names
     *
     * @return array
     */
    protected function getRoleNames()
    {
        return ['professional'];
    }
}
