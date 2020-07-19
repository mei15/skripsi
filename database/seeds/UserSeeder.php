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
                'name' => "Dosen",
                "username" => "dosen",
                "id_num" => "12345678",
                "tlp" => "085775307621",
                "email" => "dosen@gmail.com",
                "password" => Hash::make('dosen'),
                "level_id" => 3
            ],
        ]);
    }
}
