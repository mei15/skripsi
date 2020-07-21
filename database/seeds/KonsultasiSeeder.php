<?php

use Illuminate\Database\Seeder;
use App\Konsultasi;
use Illuminate\Support\Facades\DB;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konsultasis')->insert([
            [
                'judul' => "Sistem Pakar",
                "id_user" => 7,
                "id_dsn" => 3,
                "tgl" => now(),
                "ket" => "revisi bab 1",
            ],
            [
                'judul' => "Sistem Informasi Pegawai",
                "id_user" => 16,
                "id_dsn" => 3,
                "tgl" => now(),
                "ket" => "revisi bab 2",
            ]
        ]);
    }
}
