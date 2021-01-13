<?php

namespace App\Exports;

use App\Models\MonitoringSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataMonitoringSiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MonitoringSiswa::select('tanggal', 'nama', 'keterangan', 'image')->get();
    }

    public function headings(): array
    {
        return ['Tanggal', 'Nama', 'Keterangan',  'Image'];
    }
}
