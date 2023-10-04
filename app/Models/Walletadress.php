<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walletadress extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function setBtcServiceAttribute($value)
    {
        $this->attributes['btc_service'] = ucwords($value);
    }

   
}
