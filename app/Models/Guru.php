<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = ([
        'user_id',
        'nama',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'email',
        'phone',
        'jabatan',
    ]);
}
