<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class uom extends Model
{
    protected $table ='uom';
    protected $fillable =['id','primary_uom'];
    protected $primaryKey ='id';
}
