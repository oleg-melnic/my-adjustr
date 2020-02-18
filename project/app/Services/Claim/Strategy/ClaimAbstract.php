<?php

namespace App\Services\Claim\Strategy;

use App\Crud\CrudInterface;
use App\Crud\CrudTrait;
use App\Crud\NoInheritanceAwareInterface;
use App\Crud\NoInheritanceAwareTrait;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ClaimAbstract
 * @package Application\Service\Claim\Strategy
 */
abstract class ClaimAbstract implements CrudInterface, NoInheritanceAwareInterface
{
    use NoInheritanceAwareTrait;
    use CrudTrait;

    protected function getRepository()
    {
        return $this->getInheritanceResolver()->getRepository();
    }

    /**
     * @return string
     */
    public function getBaseEntityName()
    {
        return \App\Entities\Claim\Item::class;
    }

    /**
     * @param array $data
     *
     * @return \App\Entities\Claim\Item
     */
    public function createEmptyEntity(array $data)
    {
        return new \App\Entities\Claim\Item();
    }

    /**
     * @param int $perPage
     * @param string $pageName
     *
     * @return LengthAwarePaginator
     */
    abstract public function getAll($perPage = 15, $pageName = 'page');
}
