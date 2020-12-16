<?php

namespace App\model\Exports;

use App\model\pkp\komponen_klaim;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class klaimexport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return komponen_klaim::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'komponen',
            'klaim',
            'persyaratan'
        ];
    }
}
