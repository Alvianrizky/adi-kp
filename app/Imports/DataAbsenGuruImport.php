<?php

namespace App\Imports;

use App\Models\AbsenGuru;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class DataAbsenGuruImport implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.0' => 'required',
            '*.1' => 'required',
            '*.2' => 'required',
        ])->validate();

        foreach ($rows as $row) 
        {
            AbsenGuru::create([
                'tanggal'        => $row[0],
                'nama'           => $row[1],
                'absen'          => $row[2],
                'keterangan'     => $row[3]
            ]);
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
