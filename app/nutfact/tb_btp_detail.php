<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_btp_detail extends Model
{
    public function detail()
    {
    	return $this->hasMany('App\devnf\tb_btpco','btp','id_btp_detail');
    }
}