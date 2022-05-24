<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('/category/{id}', [PostController::class, 'category'])->name('posts.category');

Route::get('/user/{id}', [PostController::class, 'user'])->name('posts.user');


Route::middleware(['auth'])->group(function () {

    Route::resource('posts', PostController::class)->except('index');

    // Route::get('/dashboard', function () {
    // return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


require __DIR__.'/auth.php';