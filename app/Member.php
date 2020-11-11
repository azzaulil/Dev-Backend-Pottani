<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_member';

    protected $fillable = [
        'id_users','nama_lengkap','alamat','usia','telepon','jenis_kelamin', 'foto_profil'
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

    public function kelas(){
        return $this->hasMany(Kelas::class,'id_member');
    }

    public function produk(){
        return $this->hasMany(Produk::class,'id_member');
    }

    public function pembelian(){
        return $this->hasMany(Pembelian::class,'id_member');
    }
}
