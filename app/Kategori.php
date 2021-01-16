<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori', 'kategori_untuk'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function class(){
        return $this->hasMany(Kelas::class,'id_kategori');
    }

    public function post(){
        return $this->hasMany(Post::class,'id_kategori');
    }

    public function produk(){
        return $this->hasMany(Produk::class,'id_kategori');
    }
}
