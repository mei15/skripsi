<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosen')->insert([
            'prodi'         => 'TIF',
            'nip'           => '123456789',
            'first_name'    => 'Dosen',
            'last_name'     => 'Pertama',
            'created_at'    => Carbon::now(),
        ]);

        DB::table('dosen')->insert([
            'prodi'         => 'TIF',
            'nip'           => '234567890',
            'first_name'    => 'Dosen',
            'last_name'     => 'Kedua',
            'created_at'    => Carbon::now(),
        ]);
    }
}
