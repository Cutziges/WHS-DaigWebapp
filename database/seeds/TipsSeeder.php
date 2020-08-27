<?php

use Illuminate\Database\Seeder;

class TipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tips')->insert([
            'shortTip' => 'Remember to save your smartPerform documents.',
            'longTip' => 'If you don\'t save your documents manually your data will be lost.',
            'category_id' => '1',
        ]);

        DB::table('tips')->insert([
            'shortTip' => 'Hoylu Paper let\'s you collaborate digitally with analog paper!',
            'longTip' => 'You can draw on sticky notes and your drawing will be shown on the monitor.',
            'category_id' => '2',
        ]);

        DB::table('tips')->insert([
            'shortTip' => 'You can download the Nuki Lock App to open the door via App.',
            'category_id' => '1',
        ]);

        DB::table('tips')->insert([
            'shortTip' => 'MURAL imports will take some time.',
            'category_id' => '2',
        ]);
    }
}
