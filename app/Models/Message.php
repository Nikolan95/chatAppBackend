<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body','image','user_id','conversation_id','read'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    public function offeritems()
    {
        return $this->hasMany(Offeritem::class);
    }
    public function termsAndConditions()
    {
        return $this->hasMany(termsAndConditions::class);
    }
    public function file()
    {
        return $this->hasOne(File::class);
    }
}
