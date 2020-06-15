<?php

namespace App\Exports;

use App\kemas\datakemas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KemasExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return datakemas::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'nama',
            'tersier',
            's_tersier',
            'sekunder1',
            's_sekunder1',
            'sekunder2',
            's_sekunder2',
            'primer',
            's_primer'
        ];
    }
}
