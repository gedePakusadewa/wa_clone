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

Route::get('/get-client-data', [HomeController::class, 'sendDataChatToClient'])->name('get_client_data');

Route::get('/send-and-get-new-data', [HomeController::class, 'saveAndSentNewDataToClient']);

Route::fallback(function(){
    return redirect()->route('home_page');
});
