<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\CarController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [UserController::class, 'register']);



Route::group(['middleware' => 'auth:api'], function () {
//Route::middleware('auth:api')->group(function() {
    Route::get('user', [UserController::class, 'current']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::get('conversations', [ConversationController::class, 'index']);
    Route::get('lastconversation', [ConversationController::class, 'lastConversation']);
    Route::get('cars', [CarController::class, 'index']);
    Route::post('conversations', [ConversationController::class, 'store']);
    Route::post('cars', [CarController::class, 'store']);
    Route::post('conversations/read', [ConversationController::class, 'messageSeen']);
    Route::post('messages', [MessageController::class, 'store']);  
    Route::post('upload', [PictureController::class, 'store']);
    Route::post('update', [UserController::class, 'update']);
    Route::post('fcm', [UserController::class, 'fcmToken']);
});


