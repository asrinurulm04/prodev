<?php

namespace App\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class aktifitasOH extends Model
{
    protected $table ='fs_aktifitas_oh';
    protected $fillable =['workcenter','gedung','direct_activity','kategori','driver'];

    public function dataoh()
    {
        return $this->hasMany('App\Modelmesin\oh','id_oh','id_aktifitasOH');
    }
}
