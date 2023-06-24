<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminMail;
use App\Models\admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', admin::class);
        $admins = admin::when($request->name, function ($query, $value) {

            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return response()->view('admin.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', admin::class);
        $roles = Role::all();
        return response()->view('admin.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.   
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', admin::class);

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:30', 'min:2'],
            'email' => ['required', 'string', 'email', 'unique:admins,email'],
            'password' => ['required', 'confirmed', 'min:7'],
            'image' => ['required', 'image', 'mimes:jpg,png']

        ]);

        if (!$validator->fails()) {

            $role = Role::findorfail($request->get('role_id'));
            $admin = new admin();
            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            $admin->password = Hash::make($request->get('password'));
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::disk('public')->delete("AdminImage/$admin->image");
                $image = $request->file('image');
                $ImageName = time() . '_' . $admin->name . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('AdminImage', $ImageName, ['disk' => 'public']);
                $admin->image = $ImageName;
            }
            $admin->save();

            if ($admin) {
                event(new Registered($admin));
                
                Mail::to($admin)->send(new AdminMail($admin));
            }

            if ($role) {
                $admin->assignRole($role);
            }

            return response()->json([
                'title' => $admin ? 'Created successfuly admin' : 'Error in adding',
                'icon' => 'success'
            ], $admin ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
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
        $admin = admin::findorfail($id);
      //  $this->authorize('update', $admin);
        $roles = Role::all();
        return response()->view('admin.edit', [
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:30', 'min:2'],
            'email' => ['required', 'string', 'email', Rule::unique('admins')->ignore($id)],
            'image' => ['nullable', 'image', 'mimes:jpg,png']

        ]);

        if (!$validator->fails()) {

            $role = Role::findorfail($request->get('role_id'));
            $admin = admin::findorfail($id);

            $this->authorize('update', $admin);

            $admin->name = $request->get('name');
            $admin->email = $request->get('email');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::disk('public')->delete("AdminImage/$admin->image");
                $image = $request->file('image');
                $ImageName = time() . '_' . $admin->name . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('AdminImage', $ImageName, ['disk' => 'public']);
                $admin->image = $ImageName;
            }
            $admin->save();

            if ($role) {
                $admin->assignRole($role);
            }

            return response()->json([
                'title' => $admin ? 'Updated successfuly admin' : 'Error in the modification process',
                'icon' => 'success'
            ], $admin ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
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
        $admin = admin::findorfail($id);
        $this->authorize('delete', $admin);
        $admin->delete();

        if ($admin) {
            return response()->json([
                'title' => 'Deleted successfuly',
                'icon' => 'success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'title' => 'Error during deletion',
                'icon' => 'success'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /***Archive data***/

    public function archive()
    {
        $this->authorize('update', admin::class);
        $admins = admin::onlyTrashed()->paginate(10);
        return response()->view('archive_hr.admin', ['admins' => $admins]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $admin = admin::withTrashed()->findorfail($id);
        $this->authorize('restore', $admin);
        $admin->restore();
        if ($admin) {

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
        $admin = admin::withTrashed()->findorfail($id);
        $this->authorize('forceDelete', $admin);
        $admin->forceDelete();
        Storage::disk('public')->delete("AdminImage/$admin->image");
        if ($admin) {

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
