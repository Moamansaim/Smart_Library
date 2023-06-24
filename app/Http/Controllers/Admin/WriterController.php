<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\writer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', writer::class);
        $writers = writer::when($request->name, function ($query, $value) {

            $query->where('name', 'like', "%$value%");
        })->latest()->paginate(10);
        return response()->view('writer.index', ['writers' => $writers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', writer::class);
        return response()->view('writer.create');
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
            'name' => ['required', 'string', 'max:30', 'min:2', 'unique:writers,name'],
            'notes' => ['nullable', 'max:200']
        ]);

        if (!$validator->fails()) {

            $writer = new writer();
            $this->authorize('create', $writer);
            $writer->name = $request->get('name');
            $writer->notes = $request->get('notes');
            $writer->save();

            return response()->json([
                'title' => $writer ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $writer ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $writer = writer::findorfail($id);
        $this->authorize('update', $writer);
        return response()->view('writer.edit', ['writer' => $writer]);
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

            $writer = writer::findorfail($id);
            $this->authorize('update', $writer);
            $writer->name = $request->get('name');
            $writer->notes = $request->get('notes');
            $writer->save();

            return response()->json([
                'title' => $writer ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $writer ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
        $writer = writer::findorfail($id);
        $this->authorize('delete', $writer);
        $writer->delete();

        if ($writer) {
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
        $this->authorize('archive', writer::class);
        $writer = writer::onlyTrashed()->paginate(10);
        return response()->view('archive.writer', ['writer' => $writer]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $writer = writer::withTrashed()->findorfail($id);
        $this->authorize('restore', $writer);
        $writer->restore();
        if ($writer) {

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
        $writer = writer::withTrashed()->findorfail($id);
        $this->authorize('forceDelete', $writer);
        $writer->forceDelete();
        if ($writer) {

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
