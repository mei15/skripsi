<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Dosen;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->insert([
            [
                'nama' => "Teguh Cahyono",
                "nip" => "12345678",
                "prodi" => "TIF",
                "id_user" => 3
            ],
            [
                'nama' => "Nofiyanti",
                "nip" => "12345678",
                "prodi" => "TIF",
                "id_user" => 4
            ]
        ]);
    }
}
