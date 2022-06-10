<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\defaultController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
// Route::get('/helper',function(){
//     return myTestFunction();
//  }); 

Route::resource('products', productController::class);
Route::get('/products-dt', [productController::class, 'productslisting'])->name('products-list');


Route::resource('categories', categoryController::class);
Route::get('/categories-dt', [categoryController::class, 'categorylisting'])->name('category-list');

Route::get('/all-categories', [defaultController::class, 'getAllCategory'])->name('all-categories');



require __DIR__.'/auth.php';
