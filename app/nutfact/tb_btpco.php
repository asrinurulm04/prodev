<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_btpco extends Model
{
    public function get_kategoribtp()
    {
    	return $this->belongsTo('App\nutfact\tb_kategori_btp','kategori','id_kategori_btp');
    }

    public function get_ingredi()
    {
    	return $this->belongsTo('App\nutfact\tb_ingredient','bahan','id_ingredient');
    }

    public function btpcos()
    {
    	return $this->hasMany('App\devnf\tb_nutrition','btp','id_btp');
    }

    public function get_btpdetail()
    {
    	return $this->belongsTo('App\nutfact\tb_btp_detail','btp','id_btp_detail');
    }
}
