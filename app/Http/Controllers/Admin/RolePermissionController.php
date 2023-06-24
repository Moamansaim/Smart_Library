<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{


    public function show($id)
    {

        $role = Role::findorfail($id);
        $rolePermissions = $role->Permissions;

        $permissions = Permission::where('guard_name', $role->guard_name)->paginate(10);

        foreach ($permissions  as $permission) {

            $permission->setAttribute('assigned', false);

            foreach ($rolePermissions as $rolePermission) {

                if ($rolePermission->id == $permission->id) {
                    $permission->setAttribute('assigned', true);
                    break;
                }
            }
        }
        return response()->view('RolePermission.show', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {

        $validator = validator($request->all(), [
            'roleid' => ['required', 'int', 'exists:roles,id'],
            'perid' => ['required', 'int', 'exists:permissions,id']
        ]);

        if (!$validator->fails()) {

            $role_id = Role::findorfail($request->post('roleid'));
            $permission_id = Permission::findorfail($request->post('perid'));

            if ($role_id->hasPermissionTo($permission_id)) {

                $role_id->revokePermissionTo($permission_id);
            } else {
                $role_id->givePermissionTo($permission_id);
            }

            return response()->json([
                'title' =>  $role_id ? 'Update success permission' : 'Error Update permission',
                'icon' => $role_id ? 'success' : 'error',
            ], $role_id ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
