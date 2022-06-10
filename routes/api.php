<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\ApiController;


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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('products-api', ProductApiController::class);
    Route::resource('categories-api', CategoryApiController::class);

    Route::get('/search-dt', [ApiController::class, 'searchApi'])->name('search-dt');
  
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
