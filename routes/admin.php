<?php


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix("admin")->group(function () {

    Route::get('login' , [App\Http\Controllers\Admin\AuthController::class , 'login'])->name('admin.login');
    Route::post('login' , [App\Http\Controllers\Admin\AuthController::class , 'dologin'])->name('admin.dologin');

    Route::group(['namespace' => 'Admin', 'middleware' => ['auth:web','is_admin']], function () {
        Route::get('/' , [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin.home');
        Route::get('home' , [App\Http\Controllers\Admin\HomeController::class , 'index'])->name('admin.home');
        Route::get('logout' , [App\Http\Controllers\Admin\AuthController::class , 'logout'])->name('admin.logout');

      
        //////////////// Mentors /////////////////
        Route::get('user/list' , [App\Http\Controllers\Admin\UsersController::class , 'users_list'])->name('admin.user');
        Route::get('user/profile/{id}' , [App\Http\Controllers\Admin\UsersController::class , 'user_profile'])->name('admin.user.profile');
        Route::post('user/save/{id}' , [App\Http\Controllers\Admin\UsersController::class , 'user_save'])->name('admin.user.save');

      
 //////////////// settings /////////////////
        Route::get('settings' , [App\Http\Controllers\Admin\SettingController::class , 'index'])->name('settings.index');
        Route::post('/settings/{settings}' , [App\Http\Controllers\Admin\SettingController::class , 'update'])->name('settings.update');
       

    });

});