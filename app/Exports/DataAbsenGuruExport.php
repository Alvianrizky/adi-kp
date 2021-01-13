<?php

namespace App\Exports;

use App\Models\AbsenGuru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataAbsenGuruExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbsenGuru::select('tanggal', 'nama', 'absen', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama', 'Absen', 'Keterangan'];
    }
}
