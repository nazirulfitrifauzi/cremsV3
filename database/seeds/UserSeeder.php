<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'admin@csc.net.my',
            'email_verified_at' => now(),
            'password' => Hash::make('Cscsb@45789'),
            'role' => 1,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Irfan bin Hashim',
            'email' => 'irfan@csc.net.my',
            'email_verified_at' => now(),
            'password' => Hash::make('Cscsb@45789'),
            'role' => 2,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Nazirul Fitri bin Fauzi',
            'email' => 'nazirul@csc.net.my',
            'email_verified_at' => now(),
            'password' => Hash::make('Cscsb@45789'),
            'role' => 3,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
