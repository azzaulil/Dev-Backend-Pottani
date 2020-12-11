<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryClass extends Model
{
    protected $table = 'class_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_class_category';

    protected $fillable = [
        'class_category',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function class(){
        return $this->hasMany(Kelas::class,'id_class_category');
    }
}
