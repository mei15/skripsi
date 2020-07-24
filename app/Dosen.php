<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dosen extends Model
{
    protected $table = 'dosen';

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
