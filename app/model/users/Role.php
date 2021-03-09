<?php

namespace App\model\users;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ms_roles';

    public function User(){
        return $this->hasMany('App\model\users\User');
    }
}
