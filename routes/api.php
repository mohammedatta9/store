<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' =>'auth:sanctum'],function(){
	Route::get('get_types', [ApiController::class,'getAllType']); // Abo Ahmad

});

	Route::post("login",[LoginController::class,'login'])->name("login"); // Abo Ahmad
	Route::post("logout",[LoginController::class,'logout'])->name("logout");
	Route::post("register",[LoginController::class,'postRegister'])->name("register"); // Abo Ahmad
	Route::post("change_password",[LoginController::class,'changePassword'])->name("changepassword");


    Route::get('getAllcountry', [ApiController::class,'getAllCountry']); // Abo Ahmad
    Route::get('getAllcity', [ApiController::class,'getAllCities']); // Abo Ahmad

    Route::get('get_city/{id}', [ApiController::class,'getCity']);
    Route::get('get_type/{id}', [ApiController::class,'getType']);


    Route::get('get_country/{id}', [ApiController::class,'getCountry']);
    Route::get('get_all_categories', [ApiController::class,'getAllCategories']);
    Route::get('get_category/{id}', [ApiController::class,'getCategory']);
    Route::get('get_all_tags', [ApiController::class,'getAllTags']);
    Route::get('get_tag/{id}', [ApiController::class,'getTag']);
    Route::get('get_all_currencies', [ApiController::class,'getAllCurrencies']);
    Route::get('get_currency/{id}', [ApiController::class,'getCurrency']);
    Route::get('get_latest_properties', [ApiController::class,'getLatestProperties']);
    Route::get('get_property/{id}', [ApiController::class,'getProperty']);
    Route::get('get_properties_by_city/{city_id}', [ApiController::class,'getPropertiesByCity']);
    Route::get('get_properties_by_country/{country_id}', [ApiController::class,'getPropertiesByCountry']);




Route::get('/unauthenticated', function () {
    return response()->json(["message" => "unauthenticated"]);
})->name('api.unauthenticated');
