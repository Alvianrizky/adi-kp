<?php

namespace App\Exports;

use App\Models\AbsenSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataAbsenSiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AbsenSiswa::select('tanggal', 'nama', 'absen', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama', 'Absen', 'Keterangan'];
    }
}
