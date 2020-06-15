<?php

namespace App\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class workcenter extends Model
{
    protected $table='fs_workcenter';
    protected $fillable =['workcenter','kategori'];
}
