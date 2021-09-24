<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class SubPDF extends Model
{
    protected $table = 'tr_sub_pdf';
    protected $primaryKey ='id';

    public function datapdf(){
        return $this->hasOne('App\model\pkp\ProjectPDF','id_project_pdf','pdf_id');
    }

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function departement2(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim2');
    }

    public function kemas(){
        return $this->belongsTo('App\model\kemas\datakemas','kemas_eksis','id_kemas');
    }

    public function picpdf(){
        return $this->hasOne('App\model\pkp\FileProject','pdf_id','id_project_pdf');
    }

    public function perevisi2(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }
}
