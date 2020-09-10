<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonsultasiApiController extends Controller
{
    public function index()
    {
        $konsultasi = auth()->user()->konsultasi;
 
        return response()->json(  $konsultasi );
    }
}
