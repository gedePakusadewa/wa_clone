<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'getHomePage'])->name('home_page');

Route::get('/tes123', [HomeController::class, 'tes123'])->name('tes123');

Route::fallback(function(){
    return redirect()->route('home_page');
});
