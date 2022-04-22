<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi_has_karyawan extends Model
{
    protected $table = 'absensi_has_karyawans';

    public function karyawan()
    {
    	return $this->belongsTo('App\Karyawan', 'karyawan_id', 'id');
    }

    public function absensi()
    {
    	return $this->belongsTo('App\Absensi', 'absensi_id', 'id');
    }

    protected $fillable = [
        'absensi_id', 'karyawan_id', 'status', 
    ];
}
