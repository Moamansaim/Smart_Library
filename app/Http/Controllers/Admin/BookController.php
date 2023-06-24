<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\category;
use App\Models\homePublish;
use App\Models\writer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', book::class);
        $books = book::when($request->name,function($query,$value){
            $query->where('name','like',"%$value%");
        })->latest()->paginate(10);
        return response()->view('book.index', ['books' => $books]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', book::class);
        $category = category::all();
        $writer = writer::all();
        $homePublish = homePublish::all();
        return response()->view('book.create', compact('category', 'writer', 'homePublish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', book::class);

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'max:30', 'min:2', 'unique:writers,name'],
            'version' => ['required', 'int',],
            'language' => ['required', 'string', 'max:3', 'min:2'],
            'category_id' => ['required', 'int', 'exists:categories,id'],
            'writer_id' => ['required', 'int', 'exists:writers,id'],
            'homePublish_id' => ['required', 'int', 'exists:home_publishes,id'],
            'status' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:png,jpg', 'max:2045'],
            'pdf' => ['nullable', 'mimes:pdf'],
            'notes' => ['nullable', 'max:200']
        ]);

        if (!$validator->fails()) {

            $book = new book();

            $book->name = $request->get('name');
            $book->version = $request->get('version');
            $book->language = $request->get('language');
            $book->category_id = $request->get('category_id');
            $book->writer_id = $request->get('writer_id');
            $book->homePublish_id = $request->get('homePublish_id');
            if ($request->get('status')) {
                $book->status = 'Active';
            } else {
                $book->status = 'InActive';
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                $imageName = time() . '_' . $book->name . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('Imagebook', $imageName, ['disk' => 'public']);
                $book->image = $imageName;
            }
            if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
                $image = $request->file('pdf');
                $PdfName = time() . '_' . $book->name;
                $request->file('pdf')->storePubliclyAs('Pdfbooks', $PdfName, ['disk' => 'public']);
                $book->pdf = $PdfName;
            }
            $book->notes = $request->get('notes');
            $book->save();

            return response()->json([
                'title' => $book ? 'Created successfuly' : 'Error in adding',
                'icon' => 'success'
            ], $book ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $book = book::findorfail($id);
        $this->authorize('view', $book);
        return response()->view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = book::findorfail($id);
        $this->authorize('update', $book);
        $category = category::all();
        $writer = writer::all();
        $homePublish = homePublish::all();
        return response()->view('book.edit', [
            'book' => $book,
            'category' => $category,
            'writer' => $writer,
            'homePublish' => $homePublish
        ]);
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
            'name' => ['required', 'string', 'max:30', 'min:2'],
            'version' => ['required', 'int'],
            'language' => ['required', 'string', 'max:3', 'min:2'],
            'category_id' => ['required', 'int', 'exists:categories,id'],
            'writer_id' => ['required', 'int', 'exists:writers,id'],
            'homePublish_id' => ['required', 'int', 'exists:home_publishes,id'],
            'status' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:png,jpg', 'max:2045'],
            'pdf' => ['nullable', 'mimes:pdf'],
            'notes' => ['nullable', 'max:200']
        ]);
       

        if (!$validator->fails()) {

            $book = book::findorfail($id);
            $this->authorize('update', $book);
            $book->name = $request->get('name');
            $book->version = $request->get('version');
            $book->language = $request->get('language');
            $book->category_id = $request->get('category_id');
            $book->writer_id = $request->get('writer_id');
            $book->homePublish_id = $request->get('homePublish_id');
            if ($request->get('status')) {
                $book->status = 'Active';
            } else {
                $book->status = 'InActive';
            }
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                Storage::disk('public')->delete("imagebook/$book->image");
                $image = $request->file('image');
                $imageName = time() . '_' . $book->name . '.' . $image->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('Imagebook', $imageName, ['disk' => 'public']);
                $book->image = $imageName;
            }
            if ($request->hasFile('pdf') && $request->file('pdf')->isValid()) {
                $image = $request->file('pdf');
                $PdfName = time() . '_' . $book->name;
                $request->file('pdf')->storePubliclyAs('Pdfbooks', $PdfName, ['disk' => 'public']);
                $book->pdf = $PdfName;
            }
            $book->notes = $request->get('notes');
            $book->save();

            return response()->json([
                'title' => $book ? 'Updated successfuly' : 'Error in the modification process',
                'icon' => 'success'
            ], $book ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
        $book = book::findorfail($id);
        $this->authorize('delete', $book);
        $book->delete();

        if ($book) {
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
        $this->authorize('archive', book::class);
        $books = book::onlyTrashed()->paginate(10);
        return response()->view('archive.book', ['books' => $books]);
    }

    /***Restore data***/
    public function restore($id)
    {
        $book = book::withTrashed()->findorfail($id);
        $book->restore();
        if ($book) {

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
        $book = book::withTrashed()->findorfail($id);
        $this->authorize('forceDelete', $book);
        $book->forceDelete();
        Storage::disk('public')->delete("imagebook/$book->image");
        if ($book) {

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
