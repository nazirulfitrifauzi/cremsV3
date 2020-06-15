<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_info')->insert([
            'user_id' => '3',
            'ic_no' => '910418065155',
            'address1' => 'D1, PT48012, Kampung Pulau Meranti',
            'postcode' => '47120',
            'city' => 'Puchong',
            'state' => 'selangor',
            'start_work' => Carbon::parse("2016-08-15"),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
