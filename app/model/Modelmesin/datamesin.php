<?php

namespace App\model\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class datamesin extends Model
{
    protected $table ='fs_datamesin';
    protected $primaryKey='id_data_mesin';

    protected $fillable =[
        'workcenter','gedung','kategori','Direct_Activity','nama_kategori','rate_mesin','defaultSDM','harga_sdm'
    ];

    public function datamesin()
    {
        return $this->hasMany('App\model\Modelmesin\Dmesin','id_data_mesin','id_data_mesin');
    }
}
