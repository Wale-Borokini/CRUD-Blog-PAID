<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gender extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gender) {
            $gender->slug = $gender->generateUniqueSlug();
        });
    }

    public function generateUniqueSlug()
    {
        $currentTime = time();
        $randSlug = Str::random(20);
        $slug = "{$currentTime}-{$randSlug}";
        $counter = 1;

        while (static::whereSlug($slug)->exists()) {
            $slug = "{$currentTime}-{$randSlug}-" . $counter++;
        }

        return $slug;
    }
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    
}
