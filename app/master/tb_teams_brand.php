<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class tb_teams_brand extends Model
{
    protected $table = 'tb_teams_brand';
    protected $primaryKey ='id_teams';

    public function user(){
        return $this->hasOne('App\user','id','id_user');
    }
}
