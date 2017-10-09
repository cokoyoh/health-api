<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Relation with Toke class
     */
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function transports()
    {
        return $this->hasMany(Transport::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
