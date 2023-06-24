<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangingPassword extends Controller
{

    public function ChangPassword()
    {

        return response()->view('changing_password.password');
    }

    public function Chang(Request $request)
    {

        $validator = validator($request->all(), [

            'password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed']

        ]);

        if (!$validator->fails()) {

            $guard = Auth::guard('admin') ? 'admin' : 'web';
            $auth = Auth($guard)->user();
            $auth->password = Hash::make($request->post('new_password'));
            $auth->save();

            if ($auth) {
                return response()->json([
                    "title" => 'Password changed successfully',
                    'icon' => 'success'
                ], Response::HTTP_OK);
            } else {

                return response()->json([
                    "title" => 'An error occurred changing the password',
                    'icon' => 'error'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {

            return response()->json([
                "title" => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
