<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Models\book;
use App\Models\category;
use App\Models\homePublish;
use App\Models\User;
use App\Models\writer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', category::class);
        $category = category::when($request->name, function ($query, $value) {

            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return view('category.index', ['category' => $category]);
    }

    /**
     * 
     * return cms
     * @return \Illuminate\Http\Response
     */
    public function cms()
    {


        $book = book::all();
        $category = category::all();
        $homePublish = homePublish::all();
        $writer = writer::all();
        $user = User::all();
        $admin = admin::all();
        $role = Role::all();
        $permissions = Permission::all();

        return view('home.cms', [
            "book" => $book,
            "category" => $category,
            "homePublish" => $homePublish,
            "writer" => $writer,
            "user" => $user,
            'admin' => $admin,
            "role" => $role,
            "permissions" => $permissions

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', category::class);
        return response()->view('category.create');
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

            'name' => ['required', 'string', 'max:20', 'min:2', 'unique:categories,name'],
            'notes' => ['nullable', 'max:200']

        ]);

        if (!$validator->fails()) {
            $category = new category();
            $this->authorize('create', $category);
            $category->name = $request->get('name');
            $category->notes = $request->get('notes');
            $category->save();

            return response()->json([
                'title' => $category ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $category ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $category = category::findorfail($id);
        $this->authorize('update', $category);
        return  response()->view('category.edit', ['category' => $category]);
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

            'name' => ['required', 'string', 'max:20', 'min:2'],
            'notes' => ['nullable', 'max:200']

        ]);

        if (!$validator->fails()) {
            $category = category::findorfail($id);
            $this->authorize('update', $category);
            $category->name = $request->get('name');
            $category->notes = $request->get('notes');
            $category->save();

            return response()->json([
                'title' => $category ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $category ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
        $category = category::findorfail($id);
        $this->authorize('delete', $category);
        $category->delete();

        if ($category) {
            return response()->json([
                'title' => 'Deleted succcessfuly',
                'icon' => 'success'
            ], Response::HTTP_OK);
        } else {

            return response()->json([
                'title' => 'Error during deletion',
                'icon' => 'error'

            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /***Archive data***/

    public function archive()
    {
        $this->authorize('archive', category::class);
        $category = category::onlyTrashed()->paginate(10);

        return response()->view('archive.category', ['category' => $category]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $category = category::withTrashed()->findorfail($id);
        $this->authorize('restore', $category);
        $category->restore();
        if ($category) {

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
        $category = category::withTrashed()->findorfail($id);
        $this->authorize('forceDelete', $category);
        $category->forceDelete();
        if ($category) {

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
