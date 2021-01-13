<?php

namespace App\Imports;

use Redirect;
use App\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class DataGuruImport implements ToCollection, WithStartRow
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
            '*.4' => 'required|unique:users,email',
            '*.5' => 'required|digits_between:1,14',
        ])->validate();

        foreach ($rows as $row) 
        {
            $user = User::create([
                'name'  => $row[0],
                'email' => $row[4],
                'password'  => Hash::make('password'),
                'role' => 'guru',
            ]);

            Guru::create([
                'user_id'           => $user->id,
                'nama'              => $row[0],
                'alamat'            => $row[1],
                'tempat_lahir'      => $row[2],
                'tanggal_lahir'     => $row[3],
                'email'             => $row[4],
                'phone'             => $row[5]
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