<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangingPassword;
use App\Http\Controllers\Admin\HomePublishController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\RolePermissions;
use App\Http\Controllers\Admin\User_Role_Permission;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserRolePermission;
use App\Http\Controllers\Admin\WriterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Clint\HomeBookController;
use App\Http\Controllers\File\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [CategoryController::class, 'cms'])->name('cms')->middleware(['auth:admin,web']);

Route::namespace('Admin')
    ->prefix('category')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [CategoryController::class, 'index'])->name('index.category');
        Route::get('create', [CategoryController::class, 'create'])->name('create.category');
        Route::post('store', [CategoryController::class, 'store'])->name('store.category');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('update.category');
        Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy.category');
        Route::get('archive', [CategoryController::class, 'archive'])->name('archive.category');
        Route::post('restore/{id}', [CategoryController::class, 'restore'])->name('restore.category');
        Route::delete('forceDelete/{id}', [CategoryController::class, 'forceDelete'])->name('forceDelete.category');
    });

Route::namespace('Admin')
    ->prefix('writer')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [WriterController::class, 'index'])->name('index.writer');
        Route::get('create', [WriterController::class, 'create'])->name('create.writer');
        Route::post('store', [WriterController::class, 'store'])->name('store.writer');
        Route::get('edit/{id}', [WriterController::class, 'edit'])->name('edit.writer');
        Route::put('update/{id}', [WriterController::class, 'update'])->name('update.writer');
        Route::delete('destroy/{id}', [WriterController::class, 'destroy'])->name('destroy.writer');
        Route::get('archive', [WriterController::class, 'archive'])->name('archive.writer');
        Route::post('restore/{id}', [WriterController::class, 'restore'])->name('restore.writer');
        Route::delete('forceDelete/{id}', [WriterController::class, 'forceDelete'])->name('forceDelete.writer');
    });

Route::namespace('Admin')
    ->prefix('homePublish')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [HomePublishController::class, 'index'])->name('index.homePublish');
        Route::get('create', [HomePublishController::class, 'create'])->name('create.homePublish');
        Route::post('store', [HomePublishController::class, 'store'])->name('store.homePublish');
        Route::get('edit/{id}', [HomePublishController::class, 'edit'])->name('edit.homePublish');
        Route::put('update/{id}', [HomePublishController::class, 'update'])->name('update.homePublish');
        Route::delete('destroy/{id}', [HomePublishController::class, 'destroy'])->name('destroy.homePublish');
        Route::get('archive', [HomePublishController::class, 'archive'])->name('archive.homePublish');
        Route::post('restore/{id}', [HomePublishController::class, 'restore'])->name('restore.homePublish');
        Route::delete('forceDelete/{id}', [HomePublishController::class, 'forceDelete'])->name('forceDelete.homePublish');
    });

Route::namespace('Admin')
    ->prefix('book')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [BookController::class, 'index'])->name('index.book');
        Route::get('create', [BookController::class, 'create'])->name('create.book');
        Route::post('store', [BookController::class, 'store'])->name('store.book');
        Route::get('show/{id}', [BookController::class, 'show'])->name('show.book');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('edit.book');
        Route::put('update/{id}', [BookController::class, 'update'])->name('update.book');
        Route::delete('destroy/{id}', [BookController::class, 'destroy'])->name('destroy.book');
        Route::get('archive', [BookController::class, 'archive'])->name('archive.book');
        Route::post('restore/{id}', [BookController::class, 'restore'])->name('restore.book');
        Route::delete('forceDelete/{id}', [BookController::class, 'forceDelete'])->name('forceDelete.book');
    });


Route::namespace('Admin')
    ->prefix('admin')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [AdminController::class, 'index'])->name('index.admin');
        Route::get('create', [AdminController::class, 'create'])->name('create.admin');
        Route::post('store', [AdminController::class, 'store'])->name('store.admin');
        Route::get('edit/{id}', [AdminController::class, 'edit'])->name('edit.admin');
        Route::put('update/{id}', [AdminController::class, 'update'])->name('update.admin');
        Route::delete('destroy/{id}', [AdminController::class, 'destroy'])->name('destroy.admin');
        Route::get('archive', [AdminController::class, 'archive'])->name('archive.admin');
        Route::post('restore/{id}', [AdminController::class, 'restore'])->name('restore.admin');
        Route::delete('forceDelete/{id}', [AdminController::class, 'forceDelete'])->name('forceDelete.admin');
    });

Route::namespace('Admin')
    ->prefix('user')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [UserController::class, 'index'])->name('index.user');
        Route::get('create', [UserController::class, 'create'])->name('create.user');
        Route::post('store', [UserController::class, 'store'])->name('store.user');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('edit.user');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update.user');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('delete.user');
        Route::get('archive', [UserController::class, 'archive'])->name('archive.user');
        Route::post('restore/{id}', [UserController::class, 'restore'])->name('restore.user');
        Route::delete('forceDelete/{id}', [UserController::class, 'forceDelete'])->name('forceDelete.user');
    });


Route::namespace('Admin')
    ->prefix('role')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [RoleController::class, 'index'])->name('index.role');
        Route::get('create', [RoleController::class, 'create'])->name('create.role');
        Route::post('store', [RoleController::class, 'store'])->name('store.role');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit.role');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('update.role');
        Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('delete.role');
        Route::get('archive', [RoleController::class, 'archive'])->name('archive.role');
        Route::post('restore/{id}', [RoleController::class, 'restore'])->name('restore.role');
        Route::delete('forceDelete/{id}', [RoleController::class, 'archive'])->name('forceDelete.role');
    });

Route::namespace('Admin')
    ->prefix('permissions')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('index', [PermissionsController::class, 'index'])->name('index.permissions');
        Route::get('create', [PermissionsController::class, 'create'])->name('create.permissions');
        Route::post('store', [PermissionsController::class, 'store'])->name('store.permissions');
        Route::get('edit/{id}', [PermissionsController::class, 'edit'])->name('edit.permissions');
        Route::put('update/{id}', [PermissionsController::class, 'update'])->name('update.permissions');
        Route::delete('destroy/{id}', [PermissionsController::class, 'destroy'])->name('delete.permissions');
        Route::get('archive', [PermissionsController::class, 'archive'])->name('archive.permissions');
        Route::post('restore/{id}', [PermissionsController::class, 'restore'])->name('restore.permissions');
        Route::delete('forceDelete/{id}', [PermissionsController::class, 'archive'])->name('forceDelete.permissions');
    });


Route::namespace('Admin')
    ->prefix('Role/Permission')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('show/{id}', [RolePermissionController::class, 'show'])->name('RolePermission');
        Route::post('store', [RolePermissionController::class, 'store'])->name('RolePermission.Create');
    });

Route::namespace('Admin')
    ->prefix('user/Permission')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('show/{id}', [UserRolePermission::class, 'show'])->name('RolePermission.user');
        Route::post('store', [UserRolePermission::class, 'store'])->name('RolePermission.create.user');
    });



Route::namespace('Auth')->prefix('cms/')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'ShowLogin'])->name('ShowLogin');
    Route::post('auth', [AuthController::class, 'login'])->name('login');
})->middleware('guest:admin,web');

Route::namespace('Admin')->prefix('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::namespace('file')->prefix('book')->group(function () {
    Route::get('download/{id}', [FileController::class, 'Download'])->name('download.book');
    Route::get('file/{id}', [FileController::class, 'File'])->name('file.book');
})->middleware(['auth:admin,web', 'verified']);


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:admin,web')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/cms');
})->middleware(['auth:admin,web', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return response()->json([
        'title' => 'Verification link sent!',
        'icon' => 'success'
    ]);
})->middleware(['auth:admin,web', 'throttle:6,1'])->name('verification.send');


Route::namespace('Admin')
    ->prefix('profile')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('myProfile', [ProfileController::class, 'MyProfile'])->name('admin.profile');
        Route::get('show/{id}', [ProfileController::class, 'show'])->name('ShowProfile.admin');
        Route::post('update', [ProfileController::class, 'update'])->name('update.profile');
        Route::delete('cancel/{id}', [ProfileController::class, 'cancelProfile'])->name('cancel.profile');
    })->middleware('auth:admin');


Route::namespace('Admin')
    ->prefix('password')
    ->middleware(['auth:admin,web', 'verified'])
    ->group(function () {

        Route::get('Chang/password', [ChangingPassword::class, 'ChangPassword'])->name('Chang.password');
        Route::post('Chang', [ChangingPassword::class, 'Chang'])->name('Chang');
    })->middleware('auth:admin');


Route::get('clint/book/{id?}', [HomeBookController::class, 'GetBook'])->name('clintBook');
Route::post('clint/favorite', [HomeBookController::class, 'Favorite'])->name('Favorite');


Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('SocialLogin.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('SocialLogin.callback');
