<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Subbrand extends Model
{
    protected $table = 'subbrands';
    protected $primaryKey ='id';

    public function Workbook(){
        return $this->hasMany('App\dev\Workbook');
    }
    
    public function Formula(){
        return $this->hasMany('App\dev\Formula');
    }

    public function databrand(){
        return $this->hasOne('App\master\Brand','id','brand_id');    }

    public function User(){
        return $this->belongsTo('App\User');
    }

    protected $fillabble = [
        'subbrand',
        'brand_id',
        'user_id',
    ];

}
