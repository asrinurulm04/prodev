<?php

namespace App\manager;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $table = 'pkp_pengajuan';
    protected $primaryKey ='id_pengajuan';

    public function datapdf(){
        return $this->hasOne('App\pkp\project_pdf','id_project_pdf','id_pdf');
    }

    public function datapkp(){
        return $this->hasOne('App\pkp\pkp_project','id_project','id_pkp');
    }

    public function datapromo(){
        return $this->hasOne('App\pkp\promo','id_pkp_promo','id_promo');
    }

    public function user(){
        return $this->hasOne('App\Role','id','penerima');
    }
}
