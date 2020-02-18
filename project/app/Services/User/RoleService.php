<?php

namespace App\Services\User;

use App\Crud\CrudInterface;
use App\Crud\Exception\ValidationException;
use App\Crud\Helper\DeleteTrait;
use App\Crud\Helper\ReadTrait;
use App\Crud\Helper\UpdateTrait;
use App\Crud\NoInheritanceAwareInterface;
use App\Crud\NoInheritanceAwareTrait;
use App\Entities\User\Role;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class RoleService
 *
 * @package App\Services\User
 */
class RoleService implements CrudInterface, NoInheritanceAwareInterface
{
    use NoInheritanceAwareTrait;
    use UpdateTrait;
    use DeleteTrait;
    use ReadTrait;

    protected function getRepository()
    {
        return $this->getInheritanceResolver()->getRepository();
    }

    /**
     * @param array $data
     * @param bool $flush
     * @param array $context
     * @param string $permission
     *
     * @return object
     *
     * @throws \Exception
     */
    public function create(array $data, $flush = true, array $context = [], $permission = __FUNCTION__)
    {
        EntityManager::beginTransaction();
        $context['identity'] = '';
        try {
            /** @var \App\Entities\User\Role $entity */
            $entity = $this->getInheritanceResolver()->create($data, $flush, $context, $permission);
            EntityManager::commit();
        } catch (\Exception $exception) {
            EntityManager::rollback();
            throw $exception;
        }

        return $entity;
    }

    /**
     * Create new role
     *
     * @param array $data
     *
     * @return \App\Entities\User\Role|array|object
     *
     * @throws \Exception
     */
    public function createNew(array $data)
    {
        try {
            $result = $this->create($data, true, [], __FUNCTION__);
        } catch (ValidationException $e) {
            return ['errors' => $e->getValidationMessages()];
        }

        return $result;
    }

    /**
     * @return Role[]
     */
    public function getList()
    {
        return EntityManager::getRepository(Role::class)->findAll();
    }

    /**
     * @inheritDoc
     */
    public function createEmptyEntity(array $data)
    {
        return new Role();
    }

    /**
     * @inheritDoc
     */
    public function getBaseEntityName()
    {
        return Role::class;
    }
}
