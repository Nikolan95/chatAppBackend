<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  
        'first_registration', 
        'vehicle_identification_number',
        'manufacturer_and_brand',
        'license_number',
        'holder_name',
        'holder_city',
        'holder_postcode',
        'holder_street',
        'owner_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }
}
