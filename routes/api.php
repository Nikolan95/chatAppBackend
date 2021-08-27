<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->email)->plainTextToken;
});

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    // Revoke all tokens...
    $user = $request->user();
    $user->tokens()->delete();
    return 'Tokens are deleted';
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    //Route::middleware('auth:api')->group(function() {
        Route::get('user', [UserController::class, 'current']);
        //Route::post('logout', [ApiAuthController::class, 'logout']);
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