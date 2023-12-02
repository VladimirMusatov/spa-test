<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
Route::get('/posts', [MainController::class, 'posts']);
Route::get('/get_post/{id}', [MainController::class, 'get_post']);

Route::get('/get-recaptcha-key', [MainController::class, 'recaptcha']);

Route::post('/store_post', [MainController::class, 'store'])->name('store');
Route::post('/update_post', [MainController::class, 'update'])->name('update');
Route::get('/delete_post/{id}', [MainController::class, 'delete'])->name('delete');

require __DIR__.'/auth.php';
