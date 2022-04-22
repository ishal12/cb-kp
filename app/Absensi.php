<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';

    public function karyawan()
    {
    	return $this->belongsToMany('App\Karyawan', 'absensi_has_karyawans', 'absensi_id', 'karyawan_id')->withPivot('status')->withTimestamps();;
    }

    public function absensi_has_karyawan()
    {
        return $this->hasMany('App\Absensi_has_karyawan', 'absensi_id', 'id');
    }

    public function hari_libur()
    {
        return $this->belongsTo('App\Hari_libur', 'hari_libur_id', 'id');
    }

    protected $fillable = [
        'id', 'tanggal', 'hari_libur_id',
    ];
}
