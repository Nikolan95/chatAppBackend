<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndConditions extends Model
{
    use HasFactory;

    protected $fillable = ['message_id','body'];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}