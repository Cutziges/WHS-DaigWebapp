<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category hardware
        DB::table('categories')->insert([
            'title' => 'Hardware',
            'id' => '1',
        ]);

        // Category software
        DB::table('categories')->insert([
            'title' => 'Software',
            'id' => '2',
        ]);
    }
}
