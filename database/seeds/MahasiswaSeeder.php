<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')->insert([
            'prodi'         => 'TIF',
            'nim'           => 'H1D001001',
            'first_name'    => 'Mahasiswa',
            'last_name'     => 'Pertama',
            'created_at'    => Carbon::now(),
        ]);

        DB::table('mahasiswa')->insert([
            'prodi'         => 'TIF',
            'nim'           => 'H1D001002',
            'first_name'    => 'Mahasiswa',
            'last_name'     => 'Kedua',
            'created_at'    => Carbon::now(),
        ]);
    }
}
