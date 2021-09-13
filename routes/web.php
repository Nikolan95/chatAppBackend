<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\GroupController;
use App\Events\Message as Message2;;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Message;
use App\Models\Offeritem;
use App\Models\User;
use App\Models\Group;
use App\Models\Conversation;
use App\Http\Resources\UserResourceLaravel;
use App\Http\Resources\ConversationResource;

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
    return redirect('/dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/promotion', function () {
    return view('promotion');
})->name('promotion');


Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    $contacts = User::all();
    $groups = Group::all();
    $user =  new UserResourceLaravel(auth()->user());
    $conversations = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->with('messages.file')->where('user_id',auth()->user()->id)->orWhere('second_user_id',auth()->user()->id)->with('car')->orderBy('updated_at', 'desc')->get();
    $count = count($conversations);
    // $array = [];
    for ($i = 0; $i < $count; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
                $temp = $conversations[$i];
                $conversations[$i] = $conversations[$j];
                $conversations[$j] = $temp;
            }
        }
    }
    $conversations = ConversationResource::collection($conversations);
    //return $conversations[0];
    $conversations = $conversations->toArray($conversations);
        //return $conversations;
    return view('chat')
    ->with('user', $user)
    ->with('conversations', $conversations)
    ->with('contacts', $contacts)
    ->with('groups', $groups);
    // Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('/conversation/{id}', [HomeController::class, 'conversationMessages'])->name('conversation.messages');
    // Route::get('messages/{conversation_id}', [HomeController::class, 'getMessages'])->name('messages');
    // Route::post('conversation', [HomeController::class, 'conversationCreate'])->name('conversation.create');
    // Route::post('group', [GroupController::class, 'createGroup'])->name('group.create');
    // Route::post('sendMessage', [HomeController::class, 'sendMessage'])->name('send.message');
    // Route::post('sendImage', [HomeController::class, 'sendImage'])->name('send.image');
    // Route::get('/logout', [UserController::class, 'logoutFromApp'])->name('logout');
})->name('chat');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/conversation/{id}', [HomeController::class, 'conversationMessages'])->name('conversation.messages');
    Route::get('messages/{conversation_id}', [HomeController::class, 'getMessages'])->name('messages');
    //routes for side bar
        Route::get('profilename/{conversation_id}', [SidebarController::class, 'getProfileName'])->name('profilname');
        Route::get('medias/{conversation_id}', [SidebarController::class, 'getMedias'])->name('medias');
        Route::get('kundedata/{conversation_id}', [SidebarController::class, 'getKundeData'])->name('kundedata');
        Route::get('cardata/{conversation_id}', [SidebarController::class, 'getCarData'])->name('cardata');
    Route::post('conversation', [HomeController::class, 'conversationCreate'])->name('conversation.create');
    Route::post('group', [GroupController::class, 'createGroup'])->name('group.create');
    Route::post('sendMessage', [HomeController::class, 'sendMessage'])->name('send.message');
    Route::post('sendImage', [HomeController::class, 'sendImage'])->name('send.image');
    Route::post('sendOffer', [HomeController::class, 'sendOffer'])->name('send.offer');
    Route::post('message/read/{conversation_id}', [HomeController::class, 'messageSeen'])->name('seen.message');
});
