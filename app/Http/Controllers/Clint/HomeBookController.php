<?php

namespace App\Http\Controllers\Clint;

use App\Http\Controllers\Controller;
use App\Models\book;
use App\Models\favoriteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeBookController extends Controller
{


    public function GetBook($id = null)
    {

        if ($id) {

            $book = book::where('category_id', $id)->paginate(10);

            return response()->view('Clint.book', ['book' => $book]);
        } else {
            $book = book::paginate(10);

            return response()->view('clint.book', ['book' => $book]);
        }
    }


    public function Favorite(Request $request)
    {

        $validator = validator($request->all(), [
            'book_id' => 'required|int|exists:books,id|unique:favorite_users',
        ]);

        if (!$validator->fails()) {

            $favorite = new favoriteUser();
            $favorite->book_id = $request->get('book_id');
            $favorite->user_id = auth('web')->user()->id;
            $favorite->save();

            return response()->json([
                'title' => $favorite ? 'The book has been added to favourites' : "An error occurred while adding",
                'icon' => $favorite ? 'success' : 'error'
            ], $favorite ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
 
}
