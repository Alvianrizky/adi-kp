<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataKegiatanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kegiatan::select('tanggal', 'deskripsi', 'image')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Deskripsi', 'Image'];
    }
}
