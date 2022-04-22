<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti_tanggal extends Model
{
    protected $table = 'cuti_tanggals';

    public function cuti()
    {
        return $this->belongsTo('App\Cuti', 'cuti_id', 'id');
    }
    public function cuti_jenis()
    {
        return $this->belongsTo('App\Cuti', 'cuti_jenis_cuti_id', 'jenis_cuti_id');
    }
    public function cuti_karyawan()
    {
        return $this->belongsTo('App\Cuti', 'cuti_karyawan_id', 'karyawan_id');
    }
    public function cuti_jabatan()
    {
        return $this->belongsTo('App\Cuti', 'cuti_jabatan_id', 'jabatan_id');
    }

    protected $fillable = [
        'id', 'tanggal', 'status', 'cuti_id', 'cuti_jenis_cuti_id', 'cuti_karyawan_id', 'cuti_karyawan_jabatan_id', 'kategori',
    ];
}
