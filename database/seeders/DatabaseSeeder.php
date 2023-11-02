<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\UsrSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\CommuneRegionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsrSeeder::class);
        $this->call(CommuneRegionSeeder::class);
    }
}
