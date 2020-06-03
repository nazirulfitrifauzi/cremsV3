<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title' => 'System Admin',
            'description' => 'Managing overall system',
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'roles' => 1
        ]);

        DB::table('roles')->insert([
            'title' => 'HR Admin',
            'description' => 'Handling HR matter for the staff',
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'roles' => 0
        ]);

        DB::table('roles')->insert([
            'title' => 'Staff',
            'description' => "CSC's staff",
            'attendances' => 1,
            'leaves' => 1,
            'claims' => 1,
            'roles' => 0
        ]);

        DB::table('roles')->insert([
            'title' => 'Client',
            'description' => "Existing CSC's clients",
            'attendances' => 0,
            'leaves' => 0,
            'claims' => 0,
            'roles' => 0
        ]);
    }
}
