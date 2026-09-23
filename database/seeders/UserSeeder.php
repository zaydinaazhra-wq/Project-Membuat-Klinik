<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' =>  'KlinikZaidina@gmail.com'],
            [
                'name' => 'Klinik Zaidina',
                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' =>  'Penulis@gmail.com'],
            [
                'name' => 'Penulis',
                'password' => bcrypt('12345678'),
                'role' => 'Penulis'
            ]
        );
    }
}
