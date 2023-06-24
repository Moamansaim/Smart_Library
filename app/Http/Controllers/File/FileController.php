<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use App\Models\book;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function Download($id)
    {

        $book = book::findorfail($id);
        return response()->download(storage_path('app/public/Pdfbooks/' . $book->pdf));
    }

    public function File($id)
    {

        $book = book::findorfail($id);
        return response()->file(storage_path('app/public/Pdfbooks/' . $book->pdf));
    }
}
