<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    protected $table = 'cutis';

    public function cuti_tanggal()
    {
        return $this->hasMany('App\Cuti_tanggal', 'cuti_id', 'id');
    }
    public function cuti_tanggal_jenis()
    {
        return $this->hasMany('App\Cuti_tanggal', 'cuti_jenis_cuti_id', 'jenis_cuti_id');
    }
    public function cuti_tanggal_jabatan()
    {
        return $this->hasMany('App\Cuti_tanggal', 'cuti_jabatan_id', 'jabatan_id');
    }
    public function cuti_tanggal_karyawan()
    {
        return $this->hasMany('App\Cuti_tanggal', 'cuti_karyawan_id', 'karyawan_id');
    }

    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id', 'id');
    }
    public function karyawan_jabatan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_jabatan_id', 'jabatan_id');
    }
    public function pimpinan()
    {
        return $this->belongsTo('App\Karyawan', 'pimpinan_id', 'karyawan_id');
    }
    public function pimpinan_jabatan()
    {
        return $this->belongsTo('App\Karyawan', 'pimpinan_jabatan_id', 'karyawan_jabatan_id');
    }

    public function jenis_cuti()
    {
        return $this->belongsTo('App\Jenis_cuti', 'jenis_cuti_id', 'id');
    }

    protected $fillable = [
        'id', 'tgl_pengajuan', 'tgl_awal', 'tgl_akhir', 'keterangan', 'status', 'jenis_cuti_id', 'karyawan_id', 'karyawan_jabatan_id', 'pimpinan_id', 'pimpinan_jabatan_id',
    ];
}
