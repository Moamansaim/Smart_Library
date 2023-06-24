<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user_pro = Socialite::driver($provider)->user();

        $user = User::where([
            'provider' => $provider,
            'provider_id' => $user_pro->id
        ])->first();

        if (!$user) {
            $user = User::create([
                'name' => $user_pro->name,
                'email' => $user_pro->email,
                'provider' => $provider,
                'provider_id' => $user_pro->id,
                'password' => Hash::make(Str::random(8)),
                'provider_token' => $user_pro->token,
            ]);
        }

        Auth::guard('web')->login($user);

        return redirect()->route('cms');
    }
}
