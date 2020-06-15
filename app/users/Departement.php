<?php

namespace App\users;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departements';
    protected $primaryKey ='id';

    public function User(){
        return $this->hasOne('App\User');
    }

    public function users(){
        return $this->hasOne('App\User','id','manager_id');
    }

    protected $fillable = [
        'dept',
        'nama_dept',
        'manager_id',
    ];

}
