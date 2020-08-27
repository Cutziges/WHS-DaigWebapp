<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TipsSeeder::class);
        $this->call(TopicSeeder::class);
        $this->call(RecommendationsSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(DocumentSeeder::class);
    }
}
