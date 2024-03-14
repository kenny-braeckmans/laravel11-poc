<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Week;

class WeeksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Week::factory()->count(100)->create();
    }
}
