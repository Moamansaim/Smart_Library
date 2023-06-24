<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $roles = Role::when($request->name,function($query,$value){
            $query->where('name','like',"%$value%");
        })->latest()->paginate(10);
        return response()->view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [

            'name' => ['required', 'string', 'max:20', 'min:2', 'unique:roles'],
            'guard_name' => ['required', 'string']

        ]);

        if (!$validator->fails()) {
            $role = new Role();
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');
            $role->save();

            return response()->json([
                'title' => $role ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $role ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return  response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findorfail($id);
        return response()->view('roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [

            'name' => ['required', 'string', 'max:20', 'min:2', Rule::unique('roles')->ignore($id)],
            'guard_name' => ['required', 'string']

        ]);

        if (!$validator->fails()) {
            $role = Role::findorfail($id);
            $role->name = $request->get('name');
            $role->guard_name = $request->get('guard_name');
            $role->save();

            return response()->json([
                'title' => $role ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $role ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return  response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findorfail($id);
        $role->delete();

        if ($role) {
            return response()->json([
                'title' => 'Deleted successfuly',
                'icon' => 'success'
            ]);
        } else {

            return response()->json([
                'title' => 'An error occurred during the deletion process',
                'icon' => 'error'
            ]);
        }
    }

    /***Archive data***/

    public function archive()
    {

        $roles = Role::onlyTrashed()->paginate(10);
        return response()->view('archive_role.role', ['roles' => $roles]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $role = Role::withTrashed()->findorfail($id);
        $role->restore();

        if ($role) {

            return response()->json([
                "title" =>  'Data has been retrieved',
                'icon' => 'success'
            ]);
        } else {

            return response()->json([
                "title" =>  'Error in the recovery process',
                'icon' => 'error'
            ]);
        }
    }

    public function forceDelete($id)
    {
        $role = Role::withTrashed()->findorfail($id);
        $role->forceDelete();

        if ($role) {

            return response()->json([
                "title" =>  'The data has been permanently deleted',
                'icon' => 'success'
            ]);
        } else {

            return response()->json([
                "title" =>  'Problem with deletion',
                'icon' => 'error'
            ]);
        }
    }
}
