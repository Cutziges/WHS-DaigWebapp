<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Radfahren
        DB::table('activities')->insert([
            'name' => 'Ride a bike!',
            'description' => 'You can rent a bike if you you like, just speak to Ms. Rottes',
            'color' => '#BCE9FF',
        ]);

        // Yoga
        DB::table('activities')->insert([
            'name' => 'Do some Yoga!',
            'description' => '',
            'color' => '#BCFFDB',
        ]);

        // Badminton
        DB::table('activities')->insert([
            'name' => 'Play badminton!',
            'description' => '',
            'color' => '#FFBCBF',
        ]);

        // Meditation
        DB::table('activities')->insert([
            'name' => 'Just relax and meditate!',
            'description' => '',
            'color' => '#E4FFBC',
        ]);

        // Joggen
        DB::table('activities')->insert([
            'name' => 'Jogging!',
            'description' => '',
            'color' => '#FFD2BC',
        ]);
    }
}
