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
    return redirect()->route('register');
});

Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard');
Route::get('/posts', [MainController::class, 'posts']);

Route::get('/get-recaptcha-key', [MainController::class, 'recaptcha']);


Route::middleware('auth')->group(function () {
    Route::get('show_post/{id}', [MainController::class, 'show'])->name('show');
    Route::get('/create_post', [MainController::class, 'create'])->name('form');
    Route::post('/store_post', [MainController::class, 'store'])->name('store');
    Route::post('/update_post', [MainController::class, 'update'])->name('update');
    Route::get('/edit_post/{id}', [MainController::class, 'edit'])->name('edit');
    Route::get('/delete_post/{id}', [MainController::class, 'delete'])->name('delete');
});




require __DIR__.'/auth.php';
