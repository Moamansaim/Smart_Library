<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Permission = Permission::when($request->name,function($query,$value){
            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return response()->view('permissions.index', ['permission' => $Permission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('permissions.create');
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

            'name' => ['required', 'string', 'max:20', 'min:2', 'unique:permissions'],
            'guard_name' => ['required', 'string']

        ]);

        if (!$validator->fails()) {
            $Permission = new Permission();
            $Permission->name = $request->get('name');
            $Permission->guard_name = $request->get('guard_name');
            $Permission->save();

            return response()->json([
                'title' => $Permission ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $Permission ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $permission = Permission::findorfail($id);
        return response()->view('permissions.edit', ['permission' => $permission]);
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

            'name' => ['required', 'string', 'max:20', 'min:2', Rule::unique('permissions')->ignore($id)],
            'guard_name' => ['required', 'string']

        ]);

        if (!$validator->fails()) {
            $permission = Permission::findorfail($id);
            $permission->name = $request->get('name');
            $permission->guard_name = $request->get('guard_name');
            $permission->save();

            return response()->json([
                'title' => $permission ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $permission ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
        $permission = Permission::findorfail($id);
        $permission->delete();

        if ($permission) {
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

        $permission = Permission::onlyTrashed()->paginate(10);
        return response()->view('archive_role.permission', ['permission' => $permission]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $permission = Permission::withTrashed()->findorfail($id);
        $permission->restore();

        if ($permission) {

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
        $permission = Permission::withTrashed()->findorfail($id);
        $permission->forceDelete();

        if ($permission) {

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
