<?php

namespace App\model\Exports;

use App\model\devnf\tb_akg;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AkgExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tb_akg::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'zat gizi',
            'satuan',
            'umum',
            'bayi',
            'anak 7-23 bulan',
            'anak 2-5 tahun',
            'ibu hamil',
            'ibu menyusui'
        ];
    }
}
