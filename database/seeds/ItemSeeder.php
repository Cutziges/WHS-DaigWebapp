<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'Surface Hub',
            'item_image' => 'surface_hub.jpg',
            'item_image_path' => '/images/dummy/',
            'category_id' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'Surface Studio',
            'item_image' => 'surface_studio.jpg',
            'item_image_path' => '/images/dummy/',
            'category_id' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'BrightLink Pro',
            'item_image' => 'brightlink.jpg',
            'item_image_path' => '/images/dummy/',
            'category_id' => '1',
        ]);

        DB::table('items')->insert([
            'name' => 'MURAL',
            'item_image' => 'mural.jpg',
            'item_image_path' => '/images/dummy/',
            'category_id' => '2',
        ]);

        DB::table('items')->insert([
            'name' => 'smartPerform',
            'item_image' => 'smartperform.png',
            'item_image_path' => '/images/dummy/',
            'category_id' => '2',
        ]);

        DB::table('items')->insert([
            'name' => 'Hoylu Paper',
            'item_image' => 'HoyluPaper.png',
            'item_image_path' => '/images/dummy/',
            'category_id' => '2',
        ]);

        DB::table('items')->insert([
            'name' => 'DEON',
            'item_image' => 'DEON.jpg',
            'item_image_path' => '/images/dummy/',
            'category_id' => '2',
        ]);
    }
}
