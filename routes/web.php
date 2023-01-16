<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Admin\Controllers\TestController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardContrller;
use App\Http\Controllers\Admin\SubCategoryController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/userprofile', [DashboardContrller::class, 'Index']);



Route::middleware(['auth', 'role:admin'])->group(function () {

   Route::controller(DashboardContrller::class)->group(function () {
        Route::get('/', 'Index');
        Route::get('/admin/dashboard', 'Index');
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::get('/admin/add-category', 'Addcategory');
        Route::get('/admin/all-category', 'Index');

    });

    Route::controller(SubCategoryController::class)->group(function () {

        Route::get('/admin/add-subcategory', 'Addsubcategory');
        Route::get('/admin/all-subcategory', 'Index');

    });

    Route::controller(ProductController::class)->group(function () {

        Route::get('/admin/add-product', 'Addproduct');
        Route::get('/admin/all-product', 'Index');

    });

    Route::controller(OrderController::class)->group(function () {

        Route::get('/admin/pending-order', 'Index');
        Route::get('/admin/canceled-order', 'Cancel');

    });


});


require __DIR__.'/auth.php';

//Route::get('/{page}','AdminController@index');

Route::get('/{page}', [AdminController::class, 'index']);
