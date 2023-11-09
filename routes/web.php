<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

*/

// Route::get('/demo', function () {
//     return view('demo');
// });

    // student route

Route::get('/',[productController::class,'index'])->name('product.index');
Route::get('/create',[productController::class, 'create'])->name('product.create');
Route::post('/store',[productController::class, 'store'])->name('product.store');
Route::get('/edit/{id}',[productController::class, 'edit'])->name('product.edit');
Route::post('/update/{id}',[productController::class, 'update'])->name('product.update');
Route::get('/delete/{id}',[productController::class, 'delete'])->name('product.delete');
