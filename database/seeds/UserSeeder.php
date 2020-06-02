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
            'avatar' => 'avatar.jpg',
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
