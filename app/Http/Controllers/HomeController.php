<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\File;
use App\Models\Offeritem;
use App\Models\TermsAndConditions;
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
    public function chat()
    {
        $contacts = User::all();
        $groups = Group::all();
        $user =  new UserResourceLaravel(auth()->user());
        $conversations = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->with('messages.file')
        ->where([ ['user_id', '=', auth()->user()->id ], ['type', '=', 'normal'] ])
        ->orWhere([['second_user_id',auth()->user()->id], ['type', '=', 'normal']])->with('car')
        ->orderBy('updated_at', 'desc')->get();
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
        return view('chatlist')
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
        $conversation = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->with('messages.file')->where('id',$conversation_id)->get();
        $count = count($conversation);
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


        return view('messages.conversation')->with('conversation', $conversation);

    }
    public function sendMessage(Request $request)
    {
        $sender = $request->user_id;
        $reciever = (int)$request->second_user_id;

        $message = new Message();
		$message->body = $request['body'];
		$message->read = 0;
		$message->user_id = auth()->id();
		$message->conversation_id = (int)$request['conversation_id'];
		$message->save();

        $conversation = $message->conversation;

        $user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->second_user_id: $conversation->user_id);
		$user->pushNotification(auth()->user()->name.' send you a message',$message->body, null, $message);


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

        $file = $request->file('image');

        if($file->extension() == 'pdf'){
            $message = new Message();

            $message->read = 0;
            $message->body = 'just_pdf_no_text';
            $message->user_id = auth()->id();
            $message->conversation_id = (int)$request['conversation_id'];
            $message->save();

            $conversation = $message->conversation;

            $fileModel = new File;

            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

            $fileModel->message_id = $message->id;
            $fileModel->name = time().'_'.$request->file('image')->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            $conversation = $message->conversation;

            $message->body = 'http://10.0.2.2:8000'.$fileModel->file_path;

            $user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->second_user_id: $conversation->user_id);
            $user->pushNotification(auth()->user()->name.' send you a message','pdf',$message->body, $message);


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
        else {
            $imageContent = file_get_contents($file);
            $base64 = base64_encode($imageContent);
            //dd($file->extension());

            //$contents = $image->openFile()->fread($image->getSize());
            //dd($contents);

            $message = new Message();
            $message->body = 'just_img_no_text';
            $message->image = $base64;
            $message->read = 0;
            $message->user_id = auth()->id();
            $message->conversation_id = (int)$request['conversation_id'];
            $message->save();

            $fileModel = new File;

            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

            $fileModel->message_id = $message->id;
            $fileModel->name = time().'_'.$request->file('image')->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();

            $message->body = 'http://10.0.2.2:8000'.$fileModel->file_path;
            $message->image = null;


            $conversation = $message->conversation;

            $user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->second_user_id: $conversation->user_id);
            $user->pushNotification(auth()->user()->name.' send you a Image','image', $message->body,$message);

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

            //return response()->json($message);
        }
    }
    public function sendOffer(Request $request)
    {
        $this->validate($request,[
            'items.*.article' => 'required',
            'items.*.name' => 'required',
            'items.*.amount' => 'required',
            'items.*.price' => 'required',
        ]);

        $sender = Auth()->id();
        $reciever = (int)$request->second_user_id;

        $message = new Message;
        $offerItem = new Offeritem;
        $termsAndConditions = new TermsAndConditions;

        $message->body = 'just_offer_no_text';
        $message->read = 0;
        $message->user_id = (int)$request->user_id;
        $message->conversation_id = (int)$request->conversation_id;

        $offerList = array();

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
            foreach($request->terms as $term){
                if($term['body'] != null){
                    $data = [
                        'message_id' => $id,
                        'body' => $term['body']
                    ];
                    TermsAndConditions::insert($data);
                }
            }
        }

        $offerItemList = Offeritem::where('message_id', $message->id)->get();
        $termsList = TermsAndConditions::where('message_id', $message->id)->get();



        $conversation = $message->conversation;

        $message->body = 'angebotNotification';
        $message->offeritems = $offerItemList;
        $message->termsandconditions = $termsList;

        $user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->second_user_id: $conversation->user_id);
        $user->pushNotification(auth()->user()->name.' send you an Angebot','Angebot', $message->body,$message);


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

        return response()->json($message);
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

        return redirect()->route('chat');
    }
    public function messageSeen($conversation_id)
    {


        $conversation = Conversation::findORFail($conversation_id);

        //return $conversation->messages;

        foreach($conversation->messages as $line){
            //$line->update(['read'=>1])->where('user_id' != auth()->id());
            DB::table('messages')->where('conversation_id', $conversation->id)->where('user_id','!=', Auth()->id())->update(['read' => 1]);
        }

        return response()->json('message seened', 200);
    }
}
