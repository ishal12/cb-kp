<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hari_libur extends Model
{
    protected $table = 'hari_liburs';

    public function absensi()
    {
        return $this->hasMany('App\Absensi', 'hari_libur_id', 'id');
    }

    protected $fillable = [
        'id', 'nama', 'tgl_awal', 'tgl_akhir', 'jenis',
    ];
}
