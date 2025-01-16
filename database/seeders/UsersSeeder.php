<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name'=>'Luis Mayta',
            'email'=>'luis.mayta@gmail.com',
            'password' => Hash::make('41887192')
        ])->assignRole('super admin');
        User::Create([
            'name'=>'Daniel Armas',
            'email'=>'darmas@padresperuanos.pe',
            'password' => Hash::make('123456789')
        ])->assignRole('administrator');



    }
}
