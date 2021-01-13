<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenGuru extends Model
{
    protected $table = 'absensi_guru';

    protected $fillable = [
        'tanggal',
        'nama',
        'absen',
        'keterangan',
    ];
}
