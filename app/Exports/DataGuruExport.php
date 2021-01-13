<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataGuruExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Guru::select('nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'email', 'phone')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Alamat', 'Tempat Lahir', 'Tanggal Lahir', 'E-mail', 'Phone'];
    }
}
