<?php

use Illuminate\Database\Seeder;

class StaffLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_leave')->insert([
            'user_id' => '3',
            'AL' => 4,
            'MC' => 3,
            'EL' => 2,
            'UP' => 0,
            'CL' => 0,
            'MP' => 0,
            'X' => 0,
            'leave' => 14,
            'year' => now()->format('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
