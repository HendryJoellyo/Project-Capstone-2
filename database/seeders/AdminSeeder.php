<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'nama'       => 'Admin',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make('admin123'), // jangan lupa encrypt
            'id_roles'   => 1, // asumsikan role admin id-nya 1
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
