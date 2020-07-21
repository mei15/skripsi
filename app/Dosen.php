<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dosen extends Model
{
    protected $table = 'dosens';


    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function dosen()
    {
        return $this->hasMany('App\Konsultasi', 'id_dsn', 'id');
    }

    public function konsultasi()
    {
        return $this->hasOne('App\Konsultasi', 'id_dsn', 'id');
    }
}
