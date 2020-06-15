<?php

namespace App\Exports;

use App\nutfact\bpom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BpomExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return bpom::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nama',
            'no',
            'kategori_pangan',
            'jenis_mikroba',
            'n',
            'c',
            'm1',
            'm2',
            'metode_analisa'
        ];
    }
}
