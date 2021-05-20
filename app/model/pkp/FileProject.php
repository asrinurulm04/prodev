<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class FileProject extends Model
{
    protected $table = "tr_file_project";
    protected $primaryKey ='id_pictures';

    public function pkp(){
        return $this->hasOne('App\model\pkp\PkpProject','id_project','pkp_id');
    }

    public function pdf(){
        return $this->hasOne('App\model\pkp\ProjectPDF','id_project_pdf','pdf_id');
    }

    public function pkppromo(){
        return $this->hasOne('App\model\pkp\promo','id_pkp_promo','promo');
    }
}
