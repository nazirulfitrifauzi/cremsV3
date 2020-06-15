<?php

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
        $this->call([
            UserSeeder::class,
            UalSeeder::class,
            StaffSeeder::class,
            StaffLeaveSeeder::class,
            StaffClaimSeeder::class,
        ]);
    }
}
