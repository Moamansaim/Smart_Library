<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = user::when($request->name, function ($query, $value) {

            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return response()->view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  validator($request->all(), [

            "name" => ['required', 'string', 'max:20', 'min:2'],
            "email" => ['required', 'string', 'email'],
            "password" => ['required', 'min:7', 'confirmed'],

        ]);

        if (!$validator->fails()) {

            $user = new User();
            $user->name  = $request->post('name');
            $user->email = $request->post('email');
            $user->password = Hash::make($request->post('password'));
            $user->save();


            return response()->json([

                'title' => $user ? 'Created successfuly user' : 'An error occurred during the creation process',
                'icon' => $user ? 'success' : 'error'

            ], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
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
        $user = User::findorfail($id);
        return response()->view('user.edit', ['user' => $user]);
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
        $validator =  validator($request->all(), [

            "name" => ['required', 'string', 'max:20', 'min:2'],
            "email" => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],
        ]);

        if (!$validator->fails()) {

            $user = User::findorfail($id);
            $user->name  = $request->get('name');
            $user->email = $request->get('email');
            $user->save();

            return response()->json([

                'title' => $user ? 'Updated successfuly user' : 'An error occurred in the modification process',
                'icon' => $user ? 'success' : 'error'

            ], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ]);
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
        $user = User::findorfail($id);
        $user->delete();

        if ($user) {
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

        $users = User::onlyTrashed()->paginate(10);
        return response()->view('archive_hr.user', ['users' => $users]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $user = User::withTrashed()->findorfail($id);
        $user->restore();

        if ($user) {

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
        $user = User::withTrashed()->findorfail($id);
        $user->forceDelete();

        if ($user) {

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
