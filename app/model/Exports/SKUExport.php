<?php

namespace App\model\Exports;

use App\model\pkp\data_sku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SKUExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return data_sku::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'no_formula',
            'nama_produk',
            'no',
            'nama_sku',
            'kode_item'
        ];
    }
}
