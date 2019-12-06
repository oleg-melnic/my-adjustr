<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\App\Http\Requests\StoreRoleRequest;
use jeremykenedy\LaravelRoles\App\Http\Requests\UpdateRoleRequest;
use jeremykenedy\LaravelRoles\App\Services\RoleFormFields;
use jeremykenedy\LaravelRoles\Traits\RolesAndPermissionsHelpersTrait;
use jeremykenedy\LaravelRoles\Traits\RolesUsageAuthTrait;

class LaravelRolesController extends Controller
{
    use RolesAndPermissionsHelpersTrait;
    use RolesUsageAuthTrait;

    /**
     * Show the roles and Permissions dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getDashboardData();

        return view($data['view'], array_merge([
            'activePage' => 'roles',
            'titlePage' => 'Roles / Permissions',
        ], $data['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service = new RoleFormFields();
        $data = $service->handle();

        return view('laravelroles::laravelroles.crud.roles.create', array_merge([
            'activePage' => 'roles',
            'titlePage' => 'New Role',
        ], $data));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param \jeremykenedy\LaravelRoles\App\Http\Requests\StoreRoleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $roleData = $request->roleFillData();
        $rolePermissions = $request->get('permissions');
        $role = $this->storeRoleWithPermissions($roleData, $rolePermissions);

        return redirect()->route('laravelroles::roles.index')
                            ->with('success', trans('laravelroles::laravelroles.flash-messages.role-create', ['role' => $role->name]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->getRole($id);

        return view('laravelroles::laravelroles.crud.roles.show', array_merge([
            'activePage' => 'roles',
            'titlePage' => 'Show Roles',
        ], compact('item')));
    }

    /**
     * Edit the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $service = new RoleFormFields($id);
        $data = $service->handle();

        return view('laravelroles::laravelroles.crud.roles.edit', array_merge([
            'activePage' => 'roles',
            'titlePage' => 'Edit Roles',
        ], $data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \jeremykenedy\LaravelRoles\App\Http\Requests\UpdateRoleRequest $request
     * @param int                                                            $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $roleData = $request->roleFillData();
        $rolePermissions = $request->get('permissions');
        $role = $this->updateRoleWithPermissions($id, $roleData, $rolePermissions);

        return redirect()->route('laravelroles::roles.index')
            ->with('success', trans('laravelroles::laravelroles.flash-messages.role-updated', ['role' => $role->name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->deleteRole($id);

        return redirect(route('laravelroles::roles.index'))
                    ->with('success', trans('laravelroles::laravelroles.flash-messages.successDeletedItem', ['type' => 'Role', 'item' => $role->name]));
    }
}
