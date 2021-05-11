<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class SubPKP extends Model
{
    protected $table = 'tr_sub_pkp';
    protected $primaryKey ='id';

    public function datapkpp(){
        return $this->hasOne('App\model\pkp\PkpProject','id_project','id_pkp');
    }

    public function for1(){
        return $this->hasOne('App\model\pkp\Forecast','id_pkp','id_pkp');
    }

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function kategori(){
        return $this->hasOne('App\model\pkp\DataPangan','id_pangan','kategori_bpom');
    }

    public function panganolahan(){
        return $this->hasOne('App\model\pkp\KategoriPangan','id_kategori','olahan');
    }

    public function katpangan(){
        return $this->hasOne('App\model\pkp\DataPangan','id_pangan','kategori_bpom');
    }

    public function Dklaim(){
        return $this->hasOne('App\model\pkp\DataKlaim','id_pkp','id_pkp');
    }

    public function tarkon(){
        return $this->hasOne('App\model\master\Tarkon','id_tarkon','akg');
    }

    public function kemas(){
        return $this->belongsTo('App\model\kemas\DataKemas','kemas_eksis','id_kemas');
    }
    
    public function Duom(){
        return $this->hasOne('App\model\pkp\UOM','id','UOM');
    }

    public function picpkp(){
        return $this->hasOne('App\model\pkp\FileProject','pkp_id','id_pkp');
    }

    public function perevisi2(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }

    public function sample(){
        return $this->hasOne('App\model\dev\Formula','workbook_id','id');
    }
}
