<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\homePublish;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomePublishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', homePublish::class);
        $home = homePublish::when($request->name, function ($query, $value) {
            
            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return response()->view('homePublish.index', ['home' => $home]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', homePublish::class);
        return response()->view('homePublish.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', homePublish::class);

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:30', 'min:2', 'unique:home_publishes,name'],
            'notes' => ['nullable', 'max:200']
        ]);

        if (!$validator->fails()) {

            $home = new homePublish();
            $home->name = $request->get('name');
            $home->notes = $request->get('notes');
            $home->save();

            return response()->json([
                'title' => $home ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $home ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $home = homePublish::findorfail($id);
        $this->authorize('update', $home);
        return response()->view('homePublish.edit', ['home' => $home]);
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
            'name' => ['required', 'string', 'max:30', 'min:2',],
            'notes' => ['nullable', 'max:200']
        ]);

        if (!$validator->fails()) {

            $home = homePublish::findorfail($id);
            $this->authorize('update', $home);
            $home->name = $request->get('name');
            $home->notes = $request->get('notes');
            $home->save();

            return response()->json([
                'title' => $home ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $home ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
        $home = homePublish::findorfail($id);
        $this->authorize('delete', $home);
        $home->delete();

        if ($home) {
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
        $this->authorize('archive', homePublish::class);
        $homePublish = homePublish::onlyTrashed()->paginate(10);
        return response()->view('archive.homePublish', ['homePublish' => $homePublish]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $homePublish = homePublish::withTrashed()->findorfail($id);
        $this->authorize('restore', homePublish::class);
        $homePublish->restore();
        if ($homePublish) {

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
        $homePublish = homePublish::withTrashed()->findorfail($id);
        $this->authorize('forceDelete', $homePublish);
        $homePublish->forceDelete();
        if ($homePublish) {

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
