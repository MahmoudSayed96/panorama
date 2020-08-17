<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Permission;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\Traits\ErrorHandlerTrait;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    use ErrorHandlerTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::where('name', '<>', 'super_admin')->paginate(RouteServiceProvider::PAGINATE_LIMIT);
        return view('admin.roles.index', compact('roles'));
    }

    public function edit(int $id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->name == 'super_admin') {
                return $this->redirectIfNotFound('admin.roles');
            }
            $permission_role = $this->getPermissions($role->id);
            if (isset($role)) {
                return view('admin.roles.edit', compact('role', 'permission_role'));
            }
            return $this->redirectIfNotFound('admin.roles');
        } catch (\Exception $ex) {
            return $this->redirectIfError('admin.roles');
        }
    }

    public function update(RoleRequest $request, int $id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role->name == 'super_admin') {
                return $this->redirectIfNotFound('admin.roles');
            }
            if (!isset($role)) {
                return $this->redirectIfError('admin.roles');
            }
            // Attach all permissions to the role
            $role->syncPermissions($request->permissions);
            return $this->redirectIfSuccess('admin.roles.edit', null, [$role->id]);
        } catch (\Exception $ex) {
            return $this->redirectIfSuccess('admin.roles');
        }
    }

    private function getPermissions(int $role_id)
    {
        $rows = DB::select('select permission_id from permission_role where role_id = ?', [$role_id]);
        $permission_ids = [];
        foreach ($rows as $row) {
            $permission_ids[] = $row->permission_id;
        }
        $data = Permission::select('id', 'name')
            ->whereIn('id', $permission_ids)
            ->get();
        $permissions = [];
        foreach ($data as $permission) {
            $permissions[] = $permission->name;
        }
        return $permissions;
    }
}
