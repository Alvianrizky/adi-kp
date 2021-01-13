<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::select('nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'email', 'phone', 'nama_orang_tua_wali')->get();
    }

    public function headings(): array
    {
        return ['Nama', 'Alamat', 'Tempat Lahir', 'Tanggal Lahir', 'E-mail', 'Phone', 'Nama Orang Tua/Wali'];
    }
}
