<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_ads';

    protected $fillable = [
        'nama_perusahaan','gambar',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }  

    protected $appends = ['image_URL'];

    public function getImageURLAttribute()
    {
        if ($this->gambar == null) {
            // abort(404);
        }
        return asset('uploads/ads/' . $this->gambar);
    }
}
