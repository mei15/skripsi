<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mhs';
    protected $fillable = ['user_id', 'nim', 'nama', 'email', 'password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
