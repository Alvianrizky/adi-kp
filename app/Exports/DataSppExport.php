<?php

namespace App\Exports;

use App\Models\Spp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSppExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Spp::select('name', 'tanggal', 'jumlah', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Tanggal', 'Jumlah', 'Keterangan'];
    }
}
