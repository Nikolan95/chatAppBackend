<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Http\Resources\ConversationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        foreach($conversations as $conversation){
            foreach($conversation->messages as $message){
                $message->image = mb_convert_encoding($message->image, 'UTF-8', 'UTF-8');
                //json_encode($message->image, JSON_INVALID_UTF8_IGNORE);
            }
        }
        
        // $conversations = ConversationResource::collection($conversations);

        // $conversations = $conversations->toArray($conversations);

        // return $conversations;

        return ConversationResource::collection($conversations);

        //return $conversations[0]->messages[0]->body;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function messageSeen(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required',
        ]);

        $conversation = Conversation::findORFail($request['conversation_id']);

        //return $conversation->messages;

        foreach($conversation->messages as $line){
            //$line->update(['read'=>1])->where('user_id' != auth()->id());
            DB::table('messages')->where('conversation_id', $conversation->id)->where('user_id','!=', Auth()->id())->update(['read' => 1]);
        }

        return response()->json('message seened', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'message' => 'required'
        ]);

        $conversation = Conversation::create([
            'user_id' => auth()->user()->id,
            'second_user_id' => $request['user_id'],
            'car_id' => $request['car_id']
        ]);
        Message::create([
            'body' => $request['message'],
            'user_id' =>auth()->user()->id,
            'conversation_id' => $conversation->id,
            'read' => false,
        ]);

        return new ConversationResource($conversation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
    public function lastConversation()
    {
        $conversations = Conversation::where('user_id',auth()->user()->id)->orWhere('second_user_id',auth()->user()->id)->orderBy('id', 'desc')->limit(1)->get();
        //$count = count($conversations);
		 $array = [];
		 for ($i = 0; $i < 1; $i++) {
			for ($j = $i + 1; $j < 1; $j++) {
				if (isset($conversations[$i]->messages->last()->id) && isset($conversations[$j]->messages->last()->id) && $conversations[$i]->messages->last()->id < $conversations[$j]->messages->last()->id) {
					$temp = $conversations[$i];
					$conversations[$i] = $conversations[$j];
					$conversations[$j] = $temp;
				}
			}
		}
        foreach($conversations as $conversation){
            foreach($conversation->messages as $message){
                $message->image = mb_convert_encoding($message->image, 'UTF-8', 'UTF-8');
                //json_encode($message->image, JSON_INVALID_UTF8_IGNORE);
            }
        }

        return ConversationResource::collection($conversations);
        //return response()->json($conversations);
    }
}
