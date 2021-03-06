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
        $data['company']= $this->company;
        $data['street']= $this->street;
        $data['city']= $this->city;
        $data['phoneNumber']= $this->phoneNumber;
		$data['email']= $this->email;
		$data['image_url']= isset($this->picture)? 'http://10.0.2.2:8000/storage/uploads/'.$this->picture->path : null;
        $data['cars'] = CarResource::collection($this->cars);
        return $data;
    }
}
