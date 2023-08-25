<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Gender;
use App\Models\Ethnicity;
use App\Models\Hair;
use App\Models\Eye;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = $post->generateUniqueSlug();
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


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function ethnicity()
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function hair()
    {
        return $this->belongsTo(Hair::class);
    }

    public function eye()
    {
        return $this->belongsTo(Eye::class);
    }

    
}
