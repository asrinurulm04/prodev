<?php

namespace App\model\Modelkemas;

use Illuminate\Database\Eloquent\Model;

class FormulaKemas extends Model
{
    protected $table ='tr_formula_kemas';
    protected $primaryKey ='id_fk';

    public $fillable = ['id_feasibility','nama_sku', 'formula_item', 'kode_sku','jumlah_primer','jumlah_kemasan','gramasi','no_formula','jenis','alokasi','kode','tgl_berlaku','jumlah_batch','jumlah_box_batch','keterangan','user','item_code','kode_komputer','supplier','dimensi','unit_dimensi','spek','line_mesin','dus_ppa','box_ppa','batch_ppa','unit_ppa','dus_net','box_net','batch_net','unit_net','waste','min_order','unit_order','harga_uom','cost','Description','cost_box','cost_dus','cost_sachet'];

    public function konsepkemas()
    {
        return $this->hasOne('App\model\Modelfn\finance','id_fk','id_konsepkemas');
    }
}
