<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class UOM extends Model
{
    protected $table ='ms_uom';
    protected $fillable =['id','primary_uom'];
    protected $primaryKey ='id';
}
