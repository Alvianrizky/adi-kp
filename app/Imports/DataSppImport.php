<?php

namespace App\Imports;

use App\Models\Spp;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class DataSppImport implements ToCollection, WithStartRow
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
            Spp::create([
                'name'        => $row[0],
                'tanggal'     => $row[1],
                'jumlah'      => $row[2],
                'keterangan'  => $row[3]
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
