<?php

namespace App\Entities;

interface FactoryInterface
{
    /**
     * @param $data
     *
     * @return object
     */
    public static function createFromScalar($data);
}
