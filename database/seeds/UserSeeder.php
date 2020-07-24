<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

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
            'username'          => 'admin',
            'email'             => 'admin@email.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('admin'),
            'created_at'        => Carbon::now(),
            'userable_id'       => 1,
            'userable_type'     => 'App\Admin'
        ]);

        // --

        DB::table('users')->insert([
            'username'          => 'dosen',
            'email'             => 'dosen@email.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('dosen'),
            'created_at'        => Carbon::now(),
            'userable_id'       => 1,
            'userable_type'     => 'App\Dosen'
        ]);

        DB::table('users')->insert([
            'username'          => 'dosen2',
            'email'             => 'dosen2@email.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('dosen2'),
            'created_at'        => Carbon::now(),
            'userable_id'       => 2,
            'userable_type'     => 'App\Dosen'
        ]);

        // --

        DB::table('users')->insert([
            'username'          => 'mahasiswa',
            'email'             => 'mahasiswa@email.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('mahasiswa'),
            'created_at'        => Carbon::now(),
            'userable_id'       => 1,
            'userable_type'     => 'App\Mahasiswa'
        ]);

        DB::table('users')->insert([
            'username'          => 'mahasiswa2',
            'email'             => 'mahasiswa2@email.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('mahasiswa2'),
            'created_at'        => Carbon::now(),
            'userable_id'       => 2,
            'userable_type'     => 'App\Mahasiswa'
        ]);
    }
}
