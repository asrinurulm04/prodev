<?php

namespace App\Imports;

use App\Modelkemas\userkemas;
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
        return new userkemas([
        'nama_sku' =>$row[0],
        'formula_item' => $row[1],
        'kode_sku' => $row[2],
        'jumlah_primer' => $row[3],
        'jumlah_kemasan' => $row[4],
        'gramasi' => $row[5],
        'no_formula' => $row[6],
        'jenis' => $row[7],
        'alokasi' => $row[8],
        'kode' => $row[9],
        'tgl_berlaku' => $row[10],
        'jumlah_batch' => $row[11],
        'jumlah_box_batch' => $row[12],
        'keterangan' => $row[13],
        'user' => $row[14],
        'item_code' => $row[15],
        'kode_komputer' => $row[16],
        'supplier' => $row[17],
        'dimensi' => $row[18],
        'unit_dimensi' => $row[19],
        'spek' => $row[20],
        'line_mesin' => $row[21],
        'dus_ppa' => $row[22],
        'box_ppa' => $row[23],
        'batch_ppa' => $row[24],
        'unit_ppa' => $row[25],
        'dus_net' => $row[26],
        'box_net' => $row[27],
        'batch_net' => $row[28],
        'unit_net' => $row[29],
        'waste' => $row[30],
        'min_order' => $row[31],
        'unit_order' => $row[32],
        'harga_uom' => $row[33],
        'cost' => $row[34],
		'Description' => $row[35],
        'cost_box' => $row[36],
        'cost_dus' => $row[37],
        'cost_sachet' => $row[38],
        ]);
    }
}
