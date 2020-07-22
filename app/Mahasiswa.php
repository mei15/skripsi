<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public function mahasiswa()
    {
        return $this->hasMany('App\Konsultasi', 'id_mhs', 'id');
    }

    public function konsultasi()
    {
        return $this->hasOne('App\Konsultasi', 'id_mhs', 'id');
    }
}
