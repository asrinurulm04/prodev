<?php

namespace App\Modelkemas;

use Illuminate\Database\Eloquent\Model;

class konsep extends Model
{
    protected $table ='fs_konsep_kemas';
    protected $primaryKey ='id_konsepkemas';
    protected $fillable =['id_feasibility','konsep','saset','S','dus','D','SBox','SB','outerpack','O','pack','gaset','GST','botol','BTL','renceng','R','gram','G','palet_batch','box_palet','box_layer','kubikasi','h_sachet','h_dus','h_sb','h_outerpack','h_pack','h_gaset','h_botol','h_renceng','h_gram','box'];
    
    public function konsep()
    {
        return $this->hasOne('App\Modelfn\finance','id_fk','id_konsepkemas');
    }
}
