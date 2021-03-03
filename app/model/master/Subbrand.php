<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Subbrand extends Model
{
    protected $table = 'ms_subbrands';
    protected $primaryKey ='id';

    
    public function Formula(){
        return $this->hasMany('App\model\dev\Formula');
    }

    public function databrand(){
        return $this->hasOne('App\model\master\Brand','id','brand_id');    }

    public function User(){
        return $this->belongsTo('App\model\users\User');
    }

    protected $fillabble = [
        'subbrand',
        'brand_id',
        'user_id',
    ];

}
