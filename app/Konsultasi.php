<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dosen()
    {
        return $this->belongsTo('App\Dosen', 'id_dsn');
    }
}
