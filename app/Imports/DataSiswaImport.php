<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class DataSiswaImport implements ToCollection, WithStartRow
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
            '*.5' => 'required|digits_between:1,14',
            '*.6' => 'required',
        ])->validate();

        foreach ($rows as $row) 
        {
            Siswa::create([
                'nama'                  => $row[0],
                'alamat'                => $row[1],
                'tempat_lahir'          => $row[2],
                'tanggal_lahir'         => $row[3],
                'email'                 => $row[4],
                'phone'                 => $row[5],
                'nama_orang_tua_wali'   => $row[6]
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
