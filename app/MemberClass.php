<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberClass extends Model
{
    protected $table = 'member_class';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_member','id_class','id_status'
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
    public function class(){
        return $this->belongsTo(Kelas::class,'id_class');
    }
    public function status(){
        return $this->belongsTo(Status::class,'id_status');
    }
}
