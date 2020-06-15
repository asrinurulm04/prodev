<?php

namespace App\Modelfn;

use Illuminate\Database\Eloquent\Model;

class finance extends Model
{
    protected $table ='fs_finance';
    protected $primaryKey='id_feasibility';
    protected $fillable =['id_feasibility','id_formula','kemungkinan','status_mesin','status_sdm','status_kemas','status_lab','message'];
    

    public function formula()
    {
        return $this->hasMany('App\dev\Formula','id','id_feasibility');
    }

    public function mesin()
    {
        return $this->hasMany('App\Modelmesin\Dmesin','id_feasibility','id_mesin');
    }

    public function oh()
    {
        return $this->hasMany('App\Modelmesin\oh','id_feasibility','id_oh');
    }

    public function std()
    {
        return $this->hasOne('App\Modelmesin\std','id_feasibility','id_SYP');
    }

    public function sdm()
    {
        return $this->hasMany('App\Modelsdm\sdm','id_feasibility','id_sdm');
    }

    public function lab()
    {
        return $this->hasOne('App\Modellab\Dlab','id_feasibility','id_lab');
    }

    public function idlab()
    {
        return $this->hasOne('App\Modellab\Dlab','id_feasibility','id_lab');
    }

    public function chat()
    {
        return $this->hasOne('App\Modellab\Dlab','id_feasibility','id_chat');
    }

    public function getCreatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}

public function getUpdatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}

}
