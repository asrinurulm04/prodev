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
        'item_code' =>$row[0],
        'kode_komputer' => $row[1],
        'Description' => $row[2],
        'jlh_pemakaian' => $row[3],
        'spek' => $row[4],
        'supplier' => $row[5],
        'min_order' => $row[6],
        'harga_uom' => $row[7],
        'cost_kemas' => $row[8],
        'line_mesin' => $row[9],
        'dus_ppa' => $row[10],
        'box_ppa' => $row[11],
        'batch_ppa' => $row[12],
        'unit_ppa' => $row[13],
        'dus_net' => $row[14],
        'box_net' => $row[15],
        'batch_net' => $row[16],
        'unit_net' => $row[17],
        'waste' => $row[18],
        'cost_box' => $row[19],
        'cost_dus' => $row[20],
        'cost_sachet' => $row[21],
        ]);
    }
}
