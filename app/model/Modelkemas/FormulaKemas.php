<?php

namespace App\model\Modelkemas;

use Illuminate\Database\Eloquent\Model;

class FormulaKemas extends Model
{
    protected $table ='tr_formula_kemas';
    protected $primaryKey ='id_fk';

    public $fillable = [
        'id_Ws',
        'item_code',
        'kode_komputer',
        'Description',
        'jlh_pemakaian',
        'spek',
        'supplier',
        'min_order',
        'harga_uom',
        'cost_kemas',
        'line_mesin',
        'dus_ppa',
        'box_ppa',
        'batch_ppa',
        'unit_ppa',
        'dus_net',
        'box_net',
        'batch_net',
        'unit_net',
        'waste',
        'unit_order',
        'cost_box',
        'cost_dus',
        'cost_sachet'];

}
