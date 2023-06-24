<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class UserRolePermission extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = validator($request->all(), [
            'userid' => ['required', 'int', 'exists:users,id'],
            'perid' => ['required', 'int', 'exists:permissions,id']
        ]);

        if (!$validator->fails()) {

            $user = User::findorfail($request->get('userid'));
            $permission = Permission::findorfail($request->get('perid'));

            if ($user->hasPermissionTo($permission)) {

                $user->revokePermissionTo($permission);
            } else {
                $user->givePermissionTo($permission);
            }

            return response()->json([

                'title' => $user ? 'Update success permission' : 'Error Update permission',
                'icon' => $user ? 'success' : 'error'

            ], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
                'title' => $validator->getMessageBag()->first(),
                'error' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findorfail($id);
        $userPermissions = $user->Permissions;

        $Permissions = Permission::where('guard_name', 'web')->paginate(10);

        foreach ($Permissions as $Permission) {

            $Permission->setAttribute('assigned', false);

            foreach ($userPermissions as $userPermission) {

                if ($userPermission->id == $Permission->id) {

                    $Permission->setAttribute('assigned', true);
                }
            }
        }

        return response()->view('userPermission.show', [
            'Permissions' => $Permissions,
            'user' => $user
        ]);
    }
}
