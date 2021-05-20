<?php

namespace App\model\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    protected $table ='tr_mesin';
    protected $primaryKey='id_data_mesin';

    protected $fillable =[
        'workcenter','gedung','kategori','Direct_Activity','nama_kategori','rate_mesin','defaultSDM','harga_sdm'
    ];

    public function datamesin()
    {
        return $this->hasMany('App\model\Modelmesin\datamesin','id_data_mesin','id_data_mesin');
    }
}
