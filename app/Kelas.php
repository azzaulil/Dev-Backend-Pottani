<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'class';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_class';

    protected $fillable = [
        'nama','poster','deskripsi','link_video','biaya', 'id_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function status(){
        return $this->belongsTo(Status::class,'id_status');
    }

}
