<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function setPlanTypeAttribute($value)
    {
        $this->attributes['plan_type'] = ucwords($value);
    }

    public function setPlanTitleAttribute($value)
    {
        $this->attributes['plan_title'] = ucfirst($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }

    protected $guarded = [];
    
}
