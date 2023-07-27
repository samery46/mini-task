<?php

use App\Http\Controllers\BlogController;
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
    return view('auth.login');
});


Route::resource('blog', BlogController::class);
Route::get('/admin', [App\Http\Controllers\BlogController::class, 'admin'])->name('admin');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\BlogController::class, 'index'])->name('index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', function () {
        return 'admin page';
    });
});
