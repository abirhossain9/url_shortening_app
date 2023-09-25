<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlShortenController;

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

Auth::routes();
Route::get('/', [UrlShortenController::class, 'index'])->name('home');
Route::post('/short-url-store', [UrlShortenController::class, 'store'])->name('url.store');
Auth::routes();
Route::get('/{code}', [UrlShortenController::class, 'mailLinkRedirection'])->name('url.redirection');
