<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use Session;
// use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'getHomepage'])->name('homepage');

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/register', function(){
    return view('register');
})->name('register');

Route::post('/save-user-data', [HomeController::class, 'validateAndSaveRegistrationData'])->name('save_registration');
Route::post('/validate-login-data', [HomeController::class, 'loginValidation'])->name('validate_login');

Route::get('/get-chat-data-from-friend-id', [HomeController::class, 'getDataChat'])->name('get_client_data');

Route::get('/save-and-get-latest-data', [HomeController::class, 'saveDataAndGetLatestData']);

Route::post('/set-and-send-new-notification', [HomeController::class, 'setAndSendNewNotification']);

Route::get('/log-out', [HomeController::class, 'signOut'])->name('log_out');

Route::fallback(function(){
    return redirect()->route('login');
});