<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offeritem extends Model
{
    use HasFactory;

    protected $fillable = ['message_id','articleNumber','name','amount','price', 'total'];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}