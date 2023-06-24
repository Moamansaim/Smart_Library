<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;

class ProfileController extends Controller
{

    public function MyProfile()
    {


        $languages = Languages::getNames();
        $countries = Countries::getNames();
        $currencies = Currencies::getNames();


        $user = Auth::guard('admin')->user();

        return  response()->view('profile_admin.profile', [

            "user" => $user,
            "languages" => $languages,
            "countries" => $countries,
            "currencies" => $currencies


        ]);
    }

    public function Update(Request $request)
    {

        $validator = validator($request->all(), [

            "upload" => ['nullable', 'image', 'mimes:png,jpg'],
            "firstName" => ['required', 'string', 'max:20', 'min:2'],
            "lastName" => ['required', 'string', 'max:30', 'min:2'],
            "email" => ['required', 'email', 'exists:admins,email'],
            "organization" => ['nullable', 'string', 'max:40', 'min:2'],
            "phoneNumber" => ['required', 'string', 'max:10'],
            "address" => ['required', 'string', 'max:40', 'min:2'],
            "state" => ['nullable', 'string', 'max:40', 'min:2'],
            "zipCode" => ['nullable', 'string'],
            "country" => ['required', 'string', 'max:30', 'min:2'],
            "language" => ['nullable', 'string', 'max:20', 'min:2'],
            "currency" => ['required', 'string', 'max:80', 'min:3']

        ]);


        if (!$validator->fails()) {

            $profile = Auth::guard('admin')->user();

            if ($request->hasFile('upload') && $request->file('upload')->isValid()) {

                $image = $request->file("upload");
                $imageName = time() . '-' . $profile->name . '.' . $image->getClientOriginalExtension();
                $request->file('upload')->storePubliclyAs('profile', $imageName, ['disk' => 'public']);
            }

            $oldImage = $profile->profile->image;

            $profile = $profile->profile->fill([


                "image" => $imageName ?? $oldImage,
                "first_name" => $request->input('firstName'),
                "last_name" => $request->input('lastName'),
                "email" => $request->input('email'),
                "organization" => $request->input('organization'),
                "phone_number" => $request->input('phoneNumber'),
                "address" => $request->input('address'),
                "state" => $request->input('state'),
                "zip_code" => $request->input('zipCode'),
                "country" => $request->input('country'),
                "language" => $request->input('language'),
                "currency" => $request->input('currency')


            ])->save();


            return response()->json([
                "title" => "Updated successfuly profile",
                'icon' => 'success'
            ], $profile ? HttpResponse::HTTP_CREATED : HttpResponse::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
                "title" => $validator->getMessageBag()->first(),
                'icon' => 'error'
            ], HttpResponse::HTTP_BAD_REQUEST);
        }
    }


    public function cancelProfile($id)
    {

        $profile = profile::findorfail($id);
        $profile->delete();

        if ($profile) {

            return response()->json([
                'title' => 'Cancel successfuly profile',
                'icon' => 'success',

            ]);
        } else {
            return response()->json([
                'title' => 'An error occurred during the cancellation process',
                'icon' => 'error'
            ]);
        }
    }


    public function show($id)
    {
        $languages = Languages::getNames();
        $countries = Countries::getNames();
        $currencies = Currencies::getNames();


        $profile = profile::where('admin_id', $id)->first();
        return response()->view('profile_admin.show', [
            'profile' => $profile,
            "languages" => $languages,
            "countries" => $countries,
            "currencies" => $currencies
        ]);
    }
}
