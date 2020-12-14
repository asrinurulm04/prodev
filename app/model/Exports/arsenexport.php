<?php

namespace App\model\Exports;

use App\model\pkp\arsen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class arsenexport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return arsen::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'jenis makanan',
            'batasan maksimum'
        ];
    }
}
