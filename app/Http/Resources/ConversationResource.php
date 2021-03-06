<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
//use App\Http\Resources\UserResource;
use App\Models\User;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['user'] = auth()->user()->id == $this->user_id ? new UserResource(User::find($this->second_user_id)) :  new UserResource(User::find($this->user_id));
        $data['created_at'] = $this->created_at;
        $data['messages'] = MessageResource::collection($this->messages);
        $data['car'] = new CarResource($this->car);
        return $data;
    }
}
