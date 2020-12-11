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
        'nama','poster', 'deskripsi', 'date_class','link_video','biaya', 'id_class_category'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function class_category(){
        return $this->belongsTo(ClassCategory::class, 'id_class_category');
    }
    public function member_class(){
        return $this->hasMany(MemberClass::class,'id_class');
    }
}
