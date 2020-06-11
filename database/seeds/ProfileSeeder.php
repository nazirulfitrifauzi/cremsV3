<?php

use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile')->insert([
            'user_id' => '1',
            'ic_no' => '000000000000',
            'phone' => '0389229588',
            'address1' => 'No. 11, Jalan 9/6, Taman IKS, Seksyen 9',
            'postcode' => '43650',
            'city' => 'Bandar Baru Bangi',
            'state' => 'selangor',
            'completed' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('profile')->insert([
            'user_id' => '2',
            'ic_no' => '940523145061',
            'phone' => '0172544643',
            'address1' => 'No. 25, Jalan 13e, Seksyen 7',
            'postcode' => '43650',
            'city' => 'Bandar Baru Bangi',
            'state' => 'selangor',
            'completed' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('profile')->insert([
            'user_id' => '3',
            'ic_no' => '910418065155',
            'phone' => '0189445211',
            'address1' => 'D1, PT48012, Kampung Pulau Meranti',
            'postcode' => '47120',
            'city' => 'Puchong',
            'state' => 'selangor',
            'completed' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
