<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\IndustrySeeder;
use Database\Seeders\FunctionalSkillSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Job::factory(30)->create();
        $this->call([
            CountrySeeder::class,
            FunctionalSkillSeeder::class,
            IndustrySeeder::class
        ]);
    }
}
