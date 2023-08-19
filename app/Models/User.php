<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'uuid';
    protected $keyType = "string";
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

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


    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class, 'user_uuid', 'uuid');
    }

    public function isAdmin(): bool
    {
        return $this->level === 'admin';
    }

    public function isUser(): bool
    {
        return $this->level === 'user';
    }

    public function hasDetailUser(): bool
    {
        return $this->userDetail()->exists();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_uuid', 'uuid');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_uuid', 'uuid');
    }
}
