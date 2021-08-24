<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        $data['surname']= $this->surname;
        $data['company']= $this->company;
        $data['street']= $this->street;
        $data['city']= $this->city;
        $data['telefon']= $this->telefon;
		$data['email']= $this->email;
		$data['image_url']= isset($this->picture)? 'http://192.168.0.12/atevApplication/atevChatApp/storage/app/public/'.$this->picture->path : null;
        $data['cars'] = CarResource::collection($this->cars);
        return $data;
    }
}
