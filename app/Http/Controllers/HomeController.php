<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Offeritem;
use App\Models\User;
use App\Models\Group;
use App\Events\Message as Message2;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResourceLaravel;
use Pusher\Pusher;

use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function main()
    {
        $contacts = User::all();
        $groups = Group::all();
        $user =  new UserResourceLaravel(auth()->user());
        $conversations = Conversation::with('messages')->with('messages.offeritems')->where('user_id',auth()->user()->id)->orWhere('second_user_id',auth()->user()->id)->with('car')->orderBy('updated_at', 'desc')->get();
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

        //dd($conversations[0]);

        return view('main')
            ->with('user', $user)
            ->with('conversations', $conversations)
            ->with('contacts', $contacts)
            ->with('groups', $groups);
    }
    public function conversationMessages($id)
    {
        $contacts = User::all();
        $user =  new UserResourceLaravel(auth()->user());
        $conversations = Conversation::where('user_id',auth()->user()->id)->orWhere('second_user_id',auth()->user()->id)->orderBy('updated_at', 'desc')->get();
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
        $conversations = $conversations->toArray($conversations);

        $conversation = Conversation::where('user_id',auth()->user()->id)->where('id', $id)->orWhere('second_user_id',auth()->user()->id)->where('id', $id)->orderBy('updated_at', 'desc')->get();
		$count = count($conversation);
		// $array = [];
		for ($i = 0; $i < $count; $i++) {
			for ($j = $i + 1; $j < $count; $j++) {
				if (isset($conversation[$i]->messages->last()->id) && isset($conversation[$j]->messages->last()->id) && $conversation[$i]->messages->last()->id < $conversation[$j]->messages->last()->id) {
					$temp = $conversation[$i];
					$conversation[$i] = $conversation[$j];
					$conversation[$j] = $temp;
				}
			}
		}
        $conversation = ConversationResource::collection($conversation);
        $conversation = $conversation->toArray($conversation);

        //return $conversation[0]->user2;

        //dd($conversation[0]->messages);

        return view('conversation')
        ->with('id', $id)
        ->with('user', $user)
        ->with('contacts', $contacts)
        ->with('conversations', $conversations)
        ->with('conversation', $conversation);
    }
    public function getMessages($conversation_id)
    {
        //$conversation = Conversation::where('id',$conversation_id)->get();
        $conversation = Conversation::with('messages')->with('messages.offeritems')->where('id',$conversation_id)->get();
        // $conversation = Conversation::whereHas('messages', function($q){
        //     $q->with('offeritems');
        // })->get();
        //$conversation = Message::with('conversation', 'offeritems')->where('conversation.id', $conversation_id)->get();
        $count = count($conversation);
		// $array = [];
		for ($i = 0; $i < $count; $i++) {
			for ($j = $i + 1; $j < $count; $j++) {
				if (isset($conversation[$i]->messages->last()->id) && isset($conversation[$j]->messages->last()->id) && $conversation[$i]->messages->last()->id < $conversation[$j]->messages->last()->id) {
					$temp = $conversation[$i];
					$conversation[$i] = $conversation[$j];
					$conversation[$j] = $temp;
				}
			}
		}
        //dd($conversation);
        $conversation = ConversationResource::collection($conversation);
        // foreach($conversation[0]->messages as $message){
        //     $message->image = mb_convert_encoding($message->image, 'UTF-8', 'UTF-8');
        // }
        $conversation = $conversation->toArray($conversation);

       //dd($conversation);
        //return $conversation;
            
        return view('messages.conversation')->with('conversation', $conversation);

    }
    public function sendMessage(Request $request)
    {
        $sender = $request->user_id;
        $reciever = (int)$request->second_user_id;

        $message = new Message();
		$message->body = $request['body'];
		$message->read = false;
		$message->user_id = auth()->id();
		$message->conversation_id = (int)$request['conversation_id'];
		$message->save();

        $conversation = $message->conversation;

        $user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->second_user_id: $conversation->user_id);
		$user->pushNotification(auth()->user()->name.' send you a message',$message->body,$message);
  

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $sender, 'to' => $reciever];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    public function sendImage(Request $request)
    {
        $sender = Auth()->id();
        $reciever = (int)$request->second_user_id;
        
        $image = $request->file('image');
        // $imageContent = file_get_contents($image);
        // $base64 = base64_encode($imageContent);
        // dd($base64);

        $contents = $image->openFile()->fread($image->getSize());
    //    dd($contents);

        $message = new Message();
        $message->image = $contents;
        $message->read = false;
		$message->user_id = auth()->id();
		$message->conversation_id = (int)$request['conversation_id'];
        $message->save();

        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $sender, 'to' => $reciever];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    public function sendOffer(Request $request)
    {
        $this->validate($request,[
            'items.*.article' => 'required',
            'items.*.name' => 'required',
            'items.*.amount' => 'required',
            'items.*.price' => 'required',
      ]);
     
      $message = new Message;
      $offerItem = new Offeritem;
      
      $message->read = false;
      $message->user_id = $request->user_id;
      $message->conversation_id = $request->conversation_id;

      if ($message->save()) {
          $id = $message->id;
          foreach ($request->items as $item) {
              $data = [
                 'message_id' => $id,
                 'articleNumber' => $item['article'],
                 'name' => $item['name'],
                 'amount' => $item['amount'],
                 'price' => $item['price'],
                 'total' => $item['amount']*$item['price']
              ];
              Offeritem::insert($data);
          }
      }

      
      return redirect()->route('main');
    }
    public function conversationCreate(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required',
        //     'message' => 'required'
        // ]);

        $conversation = Conversation::create([
            'user_id' => auth()->user()->id,
            'second_user_id' => $request['contact'],
        ]);
        Message::create([
            'body' => $request['message'],
            'user_id' =>auth()->user()->id,
            'conversation_id' => $conversation->id,
            'read' => false,
        ]);

        return redirect()->route('main');
    }
}
