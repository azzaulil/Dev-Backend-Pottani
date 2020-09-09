<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_produk','id_member','gambar_produk','id_jenis_produk','id_status','stok','nama_produk','harga'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function member(){
        return $this->belongsTo(Member::class,'id_member');
    }

    public function jenis_produk(){
        return $this->belongsTo(JenisProduk::class, 'id_jenis_produk');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'id_status');
    }
}
