<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringSiswa extends Model
{
    protected $table = 'monitoring';

    protected $fillable = ([
        'tanggal',
        'nama',
        'keterangan',
        'image'
    ]);
}
