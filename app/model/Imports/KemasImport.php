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
        'harga_uom' => $row[9],
        'cost_kemas' => $row[10],
        'line_mesin' => $row[11],
        'dus_ppa' => $row[12],
        'box_ppa' => $row[13],
        'batch_ppa' => $row[14],
        'unit_ppa' => $row[15],
        'dus_net' => $row[16],
        'box_net' => $row[17],
        'batch_net' => $row[18],
        'unit_net' => $row[19],
        'waste' => $row[20],
        'cost_box' => $row[21],
        'cost_dus' => $row[22],
        'cost_sachet' => $row[23],
        'cost_uom' => $row[24],
        ]);
    }
}
