<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ([
        'user_id',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'email',
        'nama_orang_tua_wali',
        'phone',
    ]);
}
