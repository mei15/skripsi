<?php

use Illuminate\Database\Seeder;
use App\Level;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            ["name" => "Admin"],
            ["name" => "Mahasiswa"],
            ["name" => "Dosen"],
        ]);
    }
}
