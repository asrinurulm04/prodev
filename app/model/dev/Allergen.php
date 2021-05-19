<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $table = 'ms_allergen';
    
    public function user(){
        return $this->hasOne('App\model\User','id','id_user');
    }
}
