<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function produk(){
        return $this->hasMany(Produk::class,'id_status');
    }   
    public function class(){
        return $this->hasMany(Kelas::class,'id_status');
    }  
}
