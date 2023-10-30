<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('indexCategory');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/edit-category', [CategoryController::class, 'edit'])->name('editCategory');
    Route::post('/update-category', [CategoryController::class, 'update'])->name('updateCategory');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('indexBrand');

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('indexProduct');

});
