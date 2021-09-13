<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Conversation;
use App\Models\Message;
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

class SidebarController extends Controller
{
    public function getProfileName($conversation_id)
    {
        $conversation = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->where('id',$conversation_id)->get();
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

        return view('sidebar.profilename')->with('conversation', $conversation);
    }
    public function getKundeData($conversation_id)
    {
        $conversation = Conversation::with('messages')->with('messages.offeritems')->with('messages.termsandconditions')->where('id',$conversation_id)->get();
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

        return view('sidebar.kundedata')->with('conversation', $conversation);
    }
    public function getCarData($conversation_id)
    {
        $conversation = Conversation::with('messages')->with('car')->with('messages.offeritems')->with('messages.termsandconditions')->where('id',$conversation_id)->get();
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

        return view('sidebar.cardata')->with('conversation', $conversation);
    }
    public function getMedias($conversation_id)
    {
        $conversation = Conversation::where('id',$conversation_id)->with(['messages' => function ($query){
            $query->whereNotNull('image');
        }])->get();
        //$count = count($conversation);
		// for ($i = 0; $i < $count; $i++) {
		// 	for ($j = $i + 1; $j < $count; $j++) {
		// 		if (isset($conversation[$i]->messages->last()->id) && isset($conversation[$j]->messages->last()->id) && $conversation[$i]->messages->last()->id < $conversation[$j]->messages->last()->id) {
		// 			$temp = $conversation[$i];
		// 			$conversation[$i] = $conversation[$j];
		// 			$conversation[$j] = $temp;
		// 		}
		// 	}
		// }
        //$conversation = ConversationResource::collection($conversation);
        $conversation = $conversation->toArray($conversation);

        return view('sidebar.medias')->with('conversation', $conversation);
        //return $conversation;
    //dd( $conversation);
    }
}
