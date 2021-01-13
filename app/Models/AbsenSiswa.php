<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenSiswa extends Model
{
    protected $table = 'absensi_siswa';

    protected $fillable = [
        'tanggal',
        'nama',
        'absen',
        'keterangan',
    ];
}
