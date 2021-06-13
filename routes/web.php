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

//Route::get('/home', [HomeController::class, 'getHomePage'])->name('home_page');

Route::get('/get-client-data', [HomeController::class, 'sendDataChatToClient'])->name('get_client_data');

Route::get('/send-and-get-new-data', [HomeController::class, 'saveAndSentNewDataToClient']);

Route::fallback(function(){
    return redirect()->route('home_page');
});

Route::get('/', function(){
    return view('login');
})->name('login');

Route::get('/register', function(){
    return view('register');
})->name('register');

Route::post('/set-user-id', [HomeController::class, 'getHomePage'])->name('home_page');
Route::post('/save-user-data', [HomeController::class, 'customRegistration'])->name('save_registration');
Route::post('/save-login-data', [HomeController::class, 'customLogin'])->name('save_login');
Route::get('/log-out', [HomeController::class, 'signOut'])->name('log_out');