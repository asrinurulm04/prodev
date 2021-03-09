<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class tr_vitamin_bb extends Model
{
    protected $table = 'tr_vitamin_bb';

    public function satuanVitA()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitA');}
    public function satuanVitB1()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB1');}
    public function satuanVitB2()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB2');}
    public function satuanVitB3()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB3');}
    public function satuanVitB5()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB5');}
    public function satuanVitB6()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB6');}
    public function satuanVitB12()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitB12');}
    public function satuanVitC()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitC');}
    public function satuanVitD()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitD');}
    public function satuanVitE()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitE');}
    public function satuanVitK()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_vitK');}
    public function satuan_folat()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_folat');}
    public function satuan_kolin()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_kolin');}
    public function satuan_biotin()
    {return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan_biotin');}
}
