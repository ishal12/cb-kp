<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';

	public function user_karyawan()
    {
        return $this->hasOne('App\User', 'karyawan_id', 'id');
    }
    public function user_jabatan()
    {
        return $this->hasOne('App\User', 'karyawan_jabatan_id', 'jabatan_id');
    }

    public function cuti()
    {
        return $this->hasMany('App\Cuti', 'karyawan_id', 'id');
    }
    public function cuti_jabatan()
    {
        return $this->hasMany('App\Cuti', 'karyawan_jabatan_id', 'jabatan_id');
    }
    public function cuti_pimpinan()
    {
        return $this->hasMany('App\Cuti', 'pimpinan_id', 'karyawan_id');
    }
    public function cuti_pimpinan_jabatan()
    {
        return $this->hasMany('App\Cuti', 'pimpinan_jabatan_id', 'karyawan_jabatan_id');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan', 'jabatan_id', 'id');
    }

    public function absensi()
    {
        return $this->belongsToMany('App\Absensi', 'absensi_has_karyawans', 'absensi_id', 'karyawan_id')->withPivot('status');
    }
    public function absensiHitung($m, $y)
    {
        dd($m);
        return $this->absensi()
            ->selectRaw('nama', count('status', '=', '1', 'as', 'jumlah'))
            ->whereMonth('tanggal', '=', $m)
            ->whereYear('tanggal', '=', $y)
            ->groupBy('nama');
    }

    public function karyawan_pimpinan()
    {
        return $this->belongsTo(self::class, 'karyawan_id', 'id');
    }
    public function karyawan_bawahan()
    {
        return $this->hasMany(self::class, 'karyawan_id', 'id');
    }
    public function karyawan_jabatan_pimpinan()
    {
        return $this->belongsTo(self::class, 'karyawan_jabatan_id', 'jabatan_id');
    }
    public function karyawan_jabatan_bawahan()
    {
        return $this->hasMany(self::class, 'karyawan_jabatan_id', 'jabatan_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama', 'alamat','kontak', 'jabatan_id', 'karyawan_id', 'karyawan_jabatan_id',
    ];
}
