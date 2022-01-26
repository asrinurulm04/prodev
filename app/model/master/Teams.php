<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'ms_teams_brand';
    protected $primaryKey ='id_teams';

    public function user(){
        return $this->hasOne('App\model\users\User','id','id_user');
    }
}
