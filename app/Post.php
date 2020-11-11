<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_post';

    protected $fillable = [
        'id_jenis_post','artikel','gambar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function jenis_post(){
        return $this->hasOne(JenisPost::class,'id_jenis_post');
    }

    public function users(){
        return $this->belongsTo(Users::class, 'id_users');
    }
}
