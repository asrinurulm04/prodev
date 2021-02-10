<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class tipp extends Model
{
    protected $table = 'tr_sub_pkp';
    protected $primaryKey ='id';

    public function datapkpp(){
        return $this->hasOne('App\model\pkp\pkp_project','id_project','id_pkp');
    }

    public function for1(){
        return $this->hasOne('App\model\pkp\data_forecast','id_pkp','id_pkp');
    }

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function datapangan(){
        return $this->hasOne('App\model\nutfact\datapangan','id_datapangan','bpom');
    }

    public function kategori(){
        return $this->hasOne('App\model\pkp\pkp_datapangan','id_pangan','kategori_bpom');
    }

    public function panganolahan(){
        return $this->hasOne('App\model\pkp\pkp_kategoripangan','id_kategori','olahan');
    }

    public function katpangan(){
        return $this->hasOne('App\model\pkp\pkp_datapangan','id_pangan','kategori_bpom');
    }

    public function Dklaim(){
        return $this->hasOne('App\model\pkp\data_klaim','id_pkp','id_pkp');
    }

    public function tarkon(){
        return $this->hasOne('App\model\master\Tarkon','id_tarkon','akg');
    }

    public function kemas(){
        return $this->belongsTo('App\model\kemas\datakemas','kemas_eksis','id_kemas');
    }
    
    public function Duom(){
        return $this->hasOne('App\model\pkp\uom','id','UOM');
    }

    public function picpkp(){
        return $this->hasOne('App\model\pkp\picture','pkp_id','id_pkp');
    }

    public function perevisi2(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }

    public function sample(){
        return $this->hasOne('App\model\dev\Formula','workbook_id','id');
    }
}
