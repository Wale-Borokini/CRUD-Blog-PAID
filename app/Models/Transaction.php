<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
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

        static::creating(function ($transaction) {
            $transaction->slug = $transaction->generateUniqueSlug();
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


    public function creditedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function performedByAdmin()
    {
        return $this->belongsTo(User::class, 'performed_by')
                    ->where('is_admin', 1); // Assuming 'is_admin' is the column indicating admins
    }

    public function performedByUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
