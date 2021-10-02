<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

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


// public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::apiResource('categories',CategoryController::class);
//Route::get('categories/search/{name}',[CategoryController::class,'search']);

// Protected routes
Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::get('categories/search/{name}',[CategoryController::class,'search']);
    Route::get('products',[ProductController::class,'index']);
    Route::post('/logout',[AuthController::class,'logout']);

});



