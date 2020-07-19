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
}
