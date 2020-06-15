<?php

use Illuminate\Database\Seeder;

class UalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ual')->insert([
            'title' => 'System Admin',
            'description' => 'Managing overall system',
            'staff' => 1,
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'ual' => 1
        ]);

        DB::table('ual')->insert([
            'title' => 'HR Admin',
            'description' => 'Handling HR matter for the staff',
            'staff' => 1,
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'ual' => 0
        ]);

        DB::table('ual')->insert([
            'title' => 'Staff',
            'description' => "CSC's staff",
            'staff' => 0,
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'ual' => 0
        ]);

        DB::table('ual')->insert([
            'title' => 'Client',
            'description' => "Existing CSC's clients",
            'staff' => 0,
            'attendances' => 0,
            'leaves' => 0,
            'claims' => 0,
            'ual' => 0
        ]);
    }
}
