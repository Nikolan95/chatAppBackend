<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceLaravel extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id']= $this->id;
		$data['name']= $this->name;
		$data['email']= $this->email;
		$data['image_url']= isset($this->picture)? 'http://localhost/atevApplication/atevChatApp/storage/app/public/'.$this->picture->path : null;
        return $data;
    }
}
