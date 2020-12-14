<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class ms_allergen extends Model
{
    protected $table = 'tb_allergen';
    
    public function user(){
        return $this->hasOne('App\model\User','id','id_user');
    }
}
