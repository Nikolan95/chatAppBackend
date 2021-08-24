<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'company', 'street', 'city', 'telefon', 'email', 'password','fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function picture()
    {
        return $this->hasOne(Picture::class);
    }
    public function group()
    {
        return $this->hasOne(Group::class);
    }
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
    public function pushNotification($title,$body,$message){

		$token = $this->fcm_token;
		

		if($token == null) return;

		$data['notification']['title']= $title;
		$data['notification']['body']= $body;
		$data['notification']['sound']= true;
		$data['priority']= 'normal';
		$data['data']['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
		$data['data']['message']=$message;
		$data['to'] = $token;
		

		$http = new \GuzzleHttp\Client(['headers'=>[
			'Centent-Type'=>'application/json',
			'Authorization'=>'key=AAAAlFoKX1A:APA91bGYkOf25ycRVca4NzSZh1Le6xKwzOGlhFI7u6T0c6NCjTWrA_dtP7gsyEbDWMv35_sQKoAZOH5rmJ2xqiO5nNVHvqAp7oQZnQ4-zJVDUmjrA_-Wf96YCO7gddP7Qj5cKKFiVTWo'
		]]);
		try {
            $response = $http->post('https://fcm.googleapis.com/fcm/send', [ 'json' =>
                    $data
            ]);
            return $response->getBody();
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
			// return $e->getCode();
            if ($e->getCode() === 400) {
                return response()->json(['ok'=>'0', 'erro'=> 'Invalid Request.'], $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }        

	}
}
