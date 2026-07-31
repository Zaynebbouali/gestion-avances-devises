<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Banque;

class BanqueSeeder extends Seeder
{
    public function run(): void
    {
        Banque::create([
            'nom' => 'BIAT',
            'code' => 'BIAT'
        ]);

        Banque::create([
            'nom' => 'STB',
            'code' => 'STB'
        ]);

        Banque::create([
            'nom' => 'BNA',
            'code' => 'BNA'
        ]);
    }
}