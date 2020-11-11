<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_pembelian','bukti_pembayaran','tgl_maks_pembayaran','is_paid'
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
}
