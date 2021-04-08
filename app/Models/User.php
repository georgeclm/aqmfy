<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cmgmyr\Messenger\Traits\Messagable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Messagable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id',
        'twitter_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function favorite()
    {
        return $this->belongsToMany(Service::class);
    }
    public function following()
    {
        return $this->belongsToMany(Seller::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function chatroom()
    {
        return $this->belongsToMany(ChatRoom::class);
    }
    static function categories()
    {
        return Category::all();
    }
}
