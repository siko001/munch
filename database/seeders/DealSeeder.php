<?php

namespace Database\Seeders;

use App\Models\Deal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DealSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() {
        Deal::factory()
            ->count(10) // Adjust the number of deals as per your requirement
            ->create();
    }
}
