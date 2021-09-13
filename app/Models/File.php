<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_path',
        'message_id'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
