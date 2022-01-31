<?php

namespace App\model\Imports;

use App\model\Modelkemas\FormulaKemas;
use Maatwebsite\Excel\Concerns\ToModel;

class KemasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FormulaKemas([
        'status' =>$row[0],
        'shelf_life' =>$row[1],
        'item_code' =>$row[2],
        'kode_komputer' => $row[3],
        'Description' => $row[4],
        'jlh_pemakaian' => $row[5],
        'spek' => $row[6],
        'supplier' => $row[7],
        'min_order' => $row[8],
        'unit_order' => $row[9],
        'harga_uom' => $row[10],
        'cost_kemas' => $row[11],
        'line_mesin' => $row[12],
        'dus_ppa' => $row[13],
        'box_ppa' => $row[14],
        'batch_ppa' => $row[15],
        'unit_ppa' => $row[16],
        'dus_net' => $row[17],
        'box_net' => $row[18],
        'batch_net' => $row[19],
        'unit_net' => $row[20],
        'waste' => $row[21],
        'cost_box' => $row[22],
        'cost_dus' => $row[23],
        'cost_sachet' => $row[24],
        'cost_uom' => $row[25],
        ]);
    }
}
