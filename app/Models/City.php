<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\State;
use App\Models\Country;
use App\Models\Post;

class City extends Model
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

        static::creating(function ($city) {
            $city->slug = $city->generateUniqueSlug();
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
