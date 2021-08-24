<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeMessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Pusher\Pusher;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeMessageRequest $request)
    {
        

        $message = new Message();
		$message->body = $request['body'];
		$message->read = false;
		$message->user_id = auth()->id();
		$message->conversation_id = (int)$request['conversation_id'];
		$message->save();

        $conversation = $message->conversation;

        $sender = auth()->id();
        $reciever;
        if((int)$conversation->second_user_id == $sender) {
            $reciever = (int)$conversation->user_id;
        }
        else {
            $reciever = (int)$conversation->second_user_id;

        }

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


		return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
