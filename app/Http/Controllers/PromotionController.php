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

class PromotionController extends Controller
{
    public function index()
    {
        $contacts = User::all();
        $groups = Group::all();
        $user =  new UserResourceLaravel(auth()->user());
        $promotion = 'promotion';
        $conversations = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->with('messages.file')
        ->where([ ['user_id', '=', auth()->user()->id ], ['type', '=', 'promotion'] ])
        ->orWhere([['second_user_id',auth()->user()->id], ['type', '=', 'promotion']])
        ->orderBy('updated_at', 'desc')->get();
        //dd($conversations);
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
        //dd($conversations);
            //return $conversations;
        return view('chatlist')
        ->with('user', $user)
        ->with('conversations', $conversations)
        ->with('contacts', $contacts)
        ->with('groups', $groups);
    }
    public function sendPromotion(Request $request)
    {
        $request->validate([
            'promotiontext' => 'required'
        ]);

        $userId = Auth()->id();

        $users = User::all()->except($userId);

        foreach($users as $user){
            $conversation = Conversation::create([
                'user_id' => auth()->user()->id,
                'second_user_id' => $user->id,
                'type' => 'promotion'
            ]);
            Message::create([
                'body' => $request['promotiontext'],
                'user_id' => $userId,
                'conversation_id' => $conversation->id,
                'read' => false,
            ]);
        }

        return 'success';

        //$userId = Auth()->id();


        //return $request->all();
    }
    public function sendPromotionMedia(Request $request)
    {
        $sender = Auth()->id();
        $reciever = (int)$request->second_user_id;

        $file = $request->file('image');

        if($file->extension() == 'pdf'){
            $userId = Auth()->id();

            $users = User::all()->except($userId);

            foreach($users as $user){
                $conversation = Conversation::create([
                    'user_id' => auth()->user()->id,
                    'second_user_id' => $user->id,
                    'type' => 'promotion'
                ]);

                $message = Message::create([
                    'body' => 'just_pdf_no_text',
                    'user_id' => $userId,
                    'conversation_id' => $conversation->id,
                    'read' => false,
                ]);
                $fileModel = new File;

                $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

                $fileModel->message_id = $message->id;
                $fileModel->name = time().'_'.$request->file('image')->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
            }
        }
        else {
            $userId = Auth()->id();

            $users = User::all()->except($userId);

            $imageContent = file_get_contents($file);
            $base64 = base64_encode($imageContent);

            foreach($users as $user){
                $conversation = Conversation::create([
                    'user_id' => auth()->user()->id,
                    'second_user_id' => $user->id,
                    'type' => 'promotion'
                ]);

                $message = Message::create([
                    'body' => 'just_img_no_text',
                    'user_id' => $userId,
                    'conversation_id' => $conversation->id,
                    'image' => $base64,
                    'read' => false,
                ]);

                $fileModel = new File;

                $fileName = time().'_'.$request->file('image')->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('uploads', $fileName, 'public');

                $fileModel->message_id = $message->id;
                $fileModel->name = time().'_'.$request->file('image')->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->save();
            }

        }
    }
}
