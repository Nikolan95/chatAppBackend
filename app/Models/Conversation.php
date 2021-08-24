<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','second_user_id', 'car_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'second_user_id');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
