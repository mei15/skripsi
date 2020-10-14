<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';

    protected $appends = [
        'mahasiswa',
        'dosen',
    ];

    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getDosenAttribute()
    {
        return $this->dosen()->first();
    }

    public function getMahasiswaAttribute()
    {
        return $this->mahasiswa()->first();
    }

    public function dosen()
    {
        return $this->belongsTo('App\Dosen');
    }

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }

    public function scopeUser($query, $user)
    {
        if ($user->userable_type == 'App\Dosen') {
            return $query->where('dosen_id', $user->userable_id);
        }
        else if ($user->userable_type == 'App\Mahasiswa') {
            return $query->where('mahasiswa_id', $user->userable_id);
        }
    }
}
