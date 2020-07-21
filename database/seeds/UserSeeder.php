<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => "Ameilia",
                "username" => "admin",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "admin@gmail.com",
                "password" => Hash::make('admin'),
                "level_id" => 1
            ],
            [
                'name' => "Mahasiswa",
                "username" => "mahasiswa",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "mahasiswa@gmail.com",
                "password" => Hash::make('mahasiswa'),
                "level_id" => 2
            ],
            [
                'name' => "Teguh Cahyono",
                "username" => "teguh",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "teguh@gmail.com",
                "password" => Hash::make('teguh'),
                "level_id" => 3
            ],
            [
                'name' => "Nofiyanti",
                "username" => "nofi",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "nofi@gmail.com",
                "password" => Hash::make('nofi'),
                "level_id" => 3
            ],

        ]);
    }
}
