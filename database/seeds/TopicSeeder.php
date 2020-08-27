<?php

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category food & drinks
        DB::table('topics')->insert([
            'title' => 'Food & Drinks',
            'id' => '1',
        ]);

        // Category art & culture
        DB::table('topics')->insert([
            'title' => 'Art & Culture',
            'id' => '2',
        ]);

        // Category sport
        DB::table('topics')->insert([
            'title' => 'Sport',
            'id' => '3',
        ]);

        // Category nature
        DB::table('topics')->insert([
            'title' => 'Nature',
            'id' => '4',
        ]);
    }
}
