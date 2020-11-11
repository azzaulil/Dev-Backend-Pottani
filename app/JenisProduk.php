<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
    protected $table = 'jenis_produk';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_jenis_produk';

    protected $fillable = [
        'jenis_produk',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function produk(){
        return $this->hasMany(Produk::class,'id_jenis_produk');
    }   
}
