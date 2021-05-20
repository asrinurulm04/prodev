<?php

namespace App\model\manager;

use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $table = 'tr_pengajuan';
    protected $primaryKey ='id_pengajuan';

    public function datapdf(){
        return $this->hasOne('App\model\pkp\ProjectPDF','id_project_pdf','id_pdf');
    }

    public function datapkp(){
        return $this->hasOne('App\model\pkp\PkpProject','id_project','id_pkp');
    }

    public function datapromo(){
        return $this->hasOne('App\model\pkp\promo','id_pkp_promo','id_promo');
    }

    public function user(){
        return $this->hasOne('App\model\users\Role','id','penerima');
    }
}
