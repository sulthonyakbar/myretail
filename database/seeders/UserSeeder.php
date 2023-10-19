<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@myretail.com',
                'no_telp' => '',
                'alamat' => '',
                'role' => 'admin',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'kasir@myretail.com',
                'no_telp' => '081239809612',
                'alamat' => 'Surabaya',
                'role' => 'kasir',
                'password' => Hash::make('abcde')
            ],
        ]);
    }
}
