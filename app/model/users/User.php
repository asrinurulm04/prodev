<?php

namespace App\model\users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'tr_users';
    
    public function Role(){
        return $this->belongsTo('App\model\users\Role');
    }

    public function Departement(){
        return $this->belongsTo('App\model\users\Departement');
    }

    public function Workbook(){
        return $this->hasMany('App\model\dev\Workbook');
    }

    public function User(){
        return $this->hasMany('App\model\dev\Bahan');
    }

    public function Subbrand(){
        return $this->hasOne('App\model\master\Subbrand');
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
