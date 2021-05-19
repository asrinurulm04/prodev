<?php

namespace App\model\kemas;

use Illuminate\Database\Eloquent\Model;

class datakemas extends Model
{
    protected $table = 'tr_kemas';
    protected $primaryKey ='id_kemas';

    protected $fillable = [
        'nama','tersier','s_tersier','sekunder1','s_sekunder1','sekunder2','s_sekunder2','primer','s_primer',
    ];

    public function eksiskemas(){
        return $this->hasOne('App\model\pv\SubPKP','kemas_eksis','id_kemas');
    }

    public function eksiskemas2(){
        return $this->hasOne('App\model\pkp\Forecast','kemas_eksis','id_kemas');
    }
}
