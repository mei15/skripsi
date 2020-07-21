<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Nur Aulia",
                "username" => "H1D016011",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "aulia@gmail.com",
                "password" => Hash::make('h1d016011'),
                "level_id" => 2
            ],
            [
                'name' => "Noveny Dwi",
                "username" => "H1D016008",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "veny@gmail.com",
                "password" => Hash::make('h1d016008'),
                "level_id" => 2
            ],
            [
                'name' => "Amalia Husna",
                "username" => "H1D016022",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "husna@gmail.com",
                "password" => Hash::make('h1d016022'),
                "level_id" => 3
            ],
        ]);
    }
}
