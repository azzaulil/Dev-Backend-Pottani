<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_users';

    protected $fillable = [
        'name', 'email', 'password','username','is_active','id_role'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ads(){
<<<<<<< HEAD
        return $this->hasMany(Ads::class,'id_users');
    }  

    public function member(){
        return $this->hasOne(Member::class, 'id_users');
    }

    public function komentar(){
        return $this->hasMany(Komentar::class, 'id_users');
=======
        return $this->hasMany(Ads::class,'id_user');
    }  

    public function member(){
        return $this->hasOne(Member::class, 'id_user');
    }

    public function komentar(){
        return $this->hasMany(Komentar::class, 'id_user');
>>>>>>> 56e65f3... add model
    }

    public function post(){
        return $this->hasMany(Post::class, 'id_post');
    }
}
