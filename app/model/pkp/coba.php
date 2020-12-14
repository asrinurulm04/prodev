<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class coba extends Model
{
    protected $table = 'tipu';
    protected $primaryKey ='id';

    public function datapdf(){
        return $this->hasOne('App\pkp\project_pdf','id_project_pdf','pdf_id');
    }

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function kemas(){
        return $this->belongsTo('App\kemas\datakemas','kemas_eksis','id_kemas');
    }

    public function picpdf(){
        return $this->hasOne('App\pkp\picture','pdf_id','id_project_pdf');
    }

    public function perevisi2(){
        return $this->hasOne('App\User','id','perevisi');
    }
}
