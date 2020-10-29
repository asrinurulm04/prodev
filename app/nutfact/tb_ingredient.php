<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_ingredient extends Model
{
    protected $table ='tb_nutfact';
    protected $primaryKey ='id_ingredient';

    public function amino()
    {
    	return $this->hasMany('App\devnf\tb_amino_acid','ingredient','id_ingredient');
    }

    public function ingredient()
    {
    	return $this->hasMany('App\nutfact\tb_nutrition','bahan','id_ingredient');
    }

    public function ingre(){
        return $this->hasMany('App\nutfact\tb_btpco','bahan','id_ingredient');
    }
}