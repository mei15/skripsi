<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dosen extends Model
{
    protected $table = "dosen";
    protected $primaryKey = "id_dosen";
    protected $fillable = ['user_id', 'email', 'nama', 'nip', 'password'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
