<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\UrlController;

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

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('url-short', [UrlController::class, 'urlShort'])->name('url-short');
Route::get('/{redirectUrl}', [UrlController::class, 'redirectUrl'])->name('redirect-url');
Route::post('remove-url', [UrlController::class, 'removeUrl'])->name('remove-url');