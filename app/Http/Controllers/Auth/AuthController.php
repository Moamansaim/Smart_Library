<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function ShowLogin(Request $request, $guard)
    {

        return response()->view('auth.login', ['guard' => $guard]);
    }

    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
            'guard' => ['required', 'in:admin,web', 'string']
        ]);

        if (!$validator->fails()) {
            $data = ['email' => $request->get('email'), 'password' => $request->get('password')];

            if (Auth::guard($request->get('guard'))->attempt($data, $request->get('remember'))) {

                return response()->json([

                    'title' => 'logged successfuly',
                    'icon' => 'success'

                ], Response::HTTP_ACCEPTED);
            } else {
                return response()->json([
                    'title' => 'You do not have an authorized account',
                    'icon' => 'error'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {

            return response()->json([

                'title' => $validator->getMessageBag()->first(),
                'icon' => 'error'

            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'web';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('ShowLogin', $guard);
    }
}
