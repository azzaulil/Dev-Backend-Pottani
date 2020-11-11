<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'detail_pembelian';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_detail_pembelian';

    protected $fillable = [
        'id_produk','total_produk',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function pembelian(){
        return $this->belongsTo(Pembelian::class,'id_pembelian');
    }  

    public function produk(){
        return $this->hasMany(Produk::class,'id_produk');
    }  
}
