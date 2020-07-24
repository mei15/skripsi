<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mhs';
    protected $fillable = ['userable_id', 'nim', 'first_name', 'last_name', 'email', 'prodi'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function konsultasi()
    {
        return $this->hasMany('App\Konsultasi');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
