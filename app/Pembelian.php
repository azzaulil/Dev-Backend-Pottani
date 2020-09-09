<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_pembelian';

    protected $fillable = [
        'id_member','tgl_transaksi','total_harga'
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

    public function pembayaran(){
        return $this->hasOne(Pembayaran::class, 'id_pembelian');
    }
}
