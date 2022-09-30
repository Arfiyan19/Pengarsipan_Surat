<?php

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

Auth::routes();

Route::get('admin/', function () {
    return view('auth.login');
})->name('admin');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::resources([
            'surat'     => App\Http\Controllers\SuratController::class,
            'profile'     => App\Http\Controllers\profileController::class,
        ]);
        Route::get('/lihat/{id}', [App\Http\Controllers\SuratController::class, 'lihat']);
        Route::get('/unduh/{id}', [App\Http\Controllers\SuratController::class, 'unduh']);
        Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    });

Route::get('/', [App\Http\Controllers\Pelanggan\IndexController::class, 'index']);
Route::get('/login', function () {
})->name('login');
