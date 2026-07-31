<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['login' => 'admin'],
            [
                'nom' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );


        User::firstOrCreate(
            ['login' => 'ahmed'],
            [
                'nom' => 'Ahmed',
                'password' => Hash::make('ahmed123'),
                'role' => 'dgf'
            ]
        );


        User::firstOrCreate(
            ['login' => 'dcoa'],
            [
                'nom' => 'dcoa',
                'password' => Hash::make('dcoa123'),
                'role' => 'dcoa'
            ]
        );
        User::firstOrCreate(
            ['login' => 'dcsp'],
            [
                'nom' => 'dcsp',
                'password' => Hash::make('dcsp123'),
                'role' => 'dcsp'
            ]
        );
    }
}