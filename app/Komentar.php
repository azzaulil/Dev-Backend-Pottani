<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'id_users','id_post','parent_id','komentar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function users(){
        return $this->belongsTo(Users::class,'id_users');
    }  
    
    public function post(){
        return $this->hasOne(Post::class,'id_post');
    }  
}
