<?php

namespace App\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class oh extends Model
{
    protected $table ='fs_dataoh';
    protected $primaryKey ='id_oh';
    protected $fillable =['id_feasibility','SDM','rate_aktifitas','hasil','standar_sdm','id_aktifitasOH'];

    public function dataoh()
    {
        return $this->belongsTo('App\Modelmesin\aktifitasOh','id_oh','id_aktifitasOH');
    }

    public function id()
    {
        return $this->hasOne('App\Modelfn\finance','id_feasibility','id_oh');
    }

    public function chatt()
    {
        return $this->hasOne('App\Modelfn\pesan','id_oh','id_chat');
    }
}
