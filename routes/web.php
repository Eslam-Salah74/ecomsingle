<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardContrller;

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


});


require __DIR__.'/auth.php';

//Route::get('/{page}','AdminController@index');

Route::get('/{page}', [AdminController::class, 'index']);
