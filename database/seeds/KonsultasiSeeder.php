<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class KonsultasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konsultasi')->insert([
            'judul'         => 'Konsultasi BAB I',
            'keterangan'    => 'Apapun yg ada di BAB I',
            'tanggal'       => Carbon::now()->addDays(1),
            'mahasiswa_id'  => 1,
            'dosen_id'      => 1,
        ]);

        DB::table('konsultasi')->insert([
            'judul'         => 'Konsultasi BAB II',
            'keterangan'    => 'Apapun yg ada di BAB II',
            'tanggal'       => Carbon::now()->addDays(2),
            'mahasiswa_id'  => 1,
            'dosen_id'      => 1,
        ]);

        DB::table('konsultasi')->insert([
            'judul'         => 'Konsultasi BAB III dan IV',
            'keterangan'    => 'Apapun yg ada di BAB III dan IV',
            'tanggal'       => Carbon::now()->addDays(3),
            'mahasiswa_id'  => 1,
            'dosen_id'      => 2,
        ]);

        DB::table('konsultasi')->insert([
            'judul'         => 'Konsultasi BAB I dan II',
            'keterangan'    => 'Apapun yg ada di BAB I dan II',
            'tanggal'       => Carbon::now()->addDays(2),
            'mahasiswa_id'  => 2,
            'dosen_id'      => 1,
        ]);

        DB::table('konsultasi')->insert([
            'judul'         => 'Konsultasi BAB III',
            'keterangan'    => 'Apapun yg ada di BAB III',
            'tanggal'       => Carbon::now()->addDays(4),
            'mahasiswa_id'  => 2,
            'dosen_id'      => 2,
        ]);
    }
}
