<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucwords($value);
    }

    public function setBrandAttribute($value)
    {
        $this->attributes['brand'] = ucwords($value);
    }

}
