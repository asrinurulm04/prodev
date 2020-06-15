<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class picture extends Model
{
    protected $table = "pkp_related_pictures";
    protected $primaryKey ='id_pictures';

    public function pkp(){
        return $this->hasOne('App\pkp\pkp_project','id_project','pkp_id');
    }

    public function pdf(){
        return $this->hasOne('App\pkp\project_pdf','id_project_pdf','pdf_id');
    }

    public function pkppromo(){
        return $this->hasOne('App\pkp\promo','id_pkp_promo','promo');
    }
}
