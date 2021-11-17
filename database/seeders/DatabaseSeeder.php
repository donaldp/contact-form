<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->persist(new AdminSeeder); // run admin seeder.
        $this->persist(new GenderSeeder); // run gender seeder.
    }

    /**
     * Persist seeders.
     *
     * @param \Illuminate\Database\Seeder $seeder
     * @return void
     */
    private function persist(Seeder $seeder)
    {
        $seeder->run();
    }
}
