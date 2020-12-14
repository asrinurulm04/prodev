<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    
    public function Role(){
        return $this->belongsTo('App\Role');
    }

    public function Departement(){
        return $this->belongsTo('App\users\Departement');
    }

    public function Workbook(){
        return $this->hasMany('App\dev\Workbook');
    }

    public function User(){
        return $this->hasMany('App\dev\Bahan');
    }

    public function Subbrand(){
        return $this->hasOne('App\master\Subbrand');
    }


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'departement_id',
        'status',
        'role_id',
    ];

    public function punyaRule($namaRule){

        if($this->role->namaRule == $namaRule){
            return true;
        }
        return false;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
