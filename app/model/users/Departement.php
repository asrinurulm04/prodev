<?php

namespace App\model\users;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departements';
    protected $primaryKey ='id';

    public function User(){
        return $this->hasOne('App\model\users\User');
    }

    public function users(){
        return $this->hasOne('App\model\user\sUser','id','manager_id');
    }

    protected $fillable = [
        'dept',
        'nama_dept',
        'manager_id',
    ];

}
