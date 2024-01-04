<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Post;
use App\Models\Transaction;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'username',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    protected static function boot(){
        parent::boot();
        
        static::creating(function ($user) {
            $user->slug = $user->generateUniqueSlug();
            $user->credit_balance = 0.00;
        });

    }
    
    public function generateUniqueSlug()
    {        
        $currentTime = time();
        $randSlug = Str::random(40);
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function performedTransactions()
    {
        return $this->hasMany(Transaction::class, 'performed_by')
                    ->where('is_admin', 0); // Assuming 'is_admin' is the column indicating admins
    }

    public function isAdmin() {
        
        return $this->is_admin;
    }

    public function isSuperAdmin() {
        
        return $this->is_super_admin;
    }

}
