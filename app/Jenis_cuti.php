<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_cuti extends Model
{
    protected $table = 'jenis_cutis';

    public function cuti()
    {
        return $this->hasMany('App\Cuti', 'jenis_cuti_id', 'id');
    }

    protected $fillable = [
        'id', 'nama', 'limit', 'kategori',
    ];
}
