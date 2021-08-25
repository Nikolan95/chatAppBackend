<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

Route::get('/', function () {
    return view('login');
});
Route::get('login', [UserController::class, 'loginPage'])->name('login');
Route::get('register', [UserController::class, 'registerPage']);

Route::post('/registerpage', [UserController::class, 'registerFromApp'])->name('user.store');
Route::get('/loginpage', [UserController::class, 'loginFromApp'])->name('user.login');
Route::post('sendOffer', [HomeController::class, 'sendOffer'])->name('send.offer');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/conversation/{id}', [HomeController::class, 'conversationMessages'])->name('conversation.messages');
    Route::get('messages/{conversation_id}', [HomeController::class, 'getMessages'])->name('messages');
    Route::post('conversation', [HomeController::class, 'conversationCreate'])->name('conversation.create');
    Route::post('group', [GroupController::class, 'createGroup'])->name('group.create');
    Route::post('sendMessage', [HomeController::class, 'sendMessage'])->name('send.message');
    Route::post('sendImage', [HomeController::class, 'sendImage'])->name('send.image');
    Route::get('/logout', [UserController::class, 'logoutFromApp'])->name('logout');
});