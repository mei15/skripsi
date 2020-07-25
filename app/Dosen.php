<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $fillable = ['userable_id', 'nip', 'first_name', 'last_name', 'email', 'prodi'];

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
