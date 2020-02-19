<?php
/**
 * Main User Service serving for base link to Admin/HomeOwner/Professional Services
 */

namespace App\Services\User\Strategy;

use App\Crud\CrudInterface;
use App\Crud\Exception\ValidationException;
use App\Crud\Helper\DeleteTrait;
use App\Crud\Helper\ReadTrait;
use App\Crud\Helper\UpdateTrait;
use App\Crud\NoInheritanceAwareInterface;
use App\Crud\NoInheritanceAwareTrait;
use App\Entities\User\Role;
use Carbon\Carbon;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class UserAbstract
 * @package Application\Service\User\Strategy
 */
abstract class UserAbstract implements
    CrudInterface,
    NoInheritanceAwareInterface
{
    use NoInheritanceAwareTrait;
    use UpdateTrait;
    use DeleteTrait;
    use ReadTrait;

    public function __construct()
    {

    }

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
            $roleRepository = EntityManager::getRepository(Role::class);
            /** @var Role $role */
            $role = $roleRepository->find(array_get($data, 'role'));
            unset($data['role']);
            /** @var \App\Entities\User\UserAbstract $entity */
            $entity = $this->getInheritanceResolver()->create($data, $flush, $context, $permission);
            $now = Carbon::now();
            $entity->addRole($role)
                ->setCreatedAt($now)
                ->setUpdatedAt($now);
            EntityManager::flush();
            EntityManager::commit();
        } catch (\Exception $exception) {
            EntityManager::rollback();
            throw $exception;
        }

        return $entity;
    }

    /**
     * Create new user
     *
     * @param array $data
     *
     * @return \App\Entities\User\UserAbstract|array|object
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
     * Change user data
     *
     * @param int   $identity
     * @param array $data
     *
     * @return \App\Entities\User\UserAbstract|array|object
     */
    public function changeData($identity, array $data)
    {
        try {
            $result = $this->update($identity, $data);
        } catch (ValidationException $e) {
            return ['errors' => $e->getValidationMessages()];
        }

        return $result;
    }

    /**
     * @return \App\Entities\User\UserAbstract[]|null
     */
    abstract public function getAll();
}
