<?php

use Illuminate\Database\Seeder;

class StaffClaimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_Claim')->insert([
            'user_id' => '3',
            'CLM' => 50.00,
            'CLO' => 75.00,
            'year' => now()->format('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
