<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function dosen()
    {
        return $this->belongsTo('App\Dosen', 'id_dsn');
    }

    public function Konsultasi()
    {
        return $this->belongsTo('App\Dosen', 'id_dsn');
    }

    public function scopeUser($query, $userId)
    {
        return $query->where('id_user', $userId);
    }
}
