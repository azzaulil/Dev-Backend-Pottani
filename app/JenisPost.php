<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPost extends Model
{
    protected $table = 'jenis_post';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_jenis_post';

    protected $fillable = [
        'jenis_post',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function post(){
        return $this->hasMany(Post::class,'id_jenis_post');
    }   
}
