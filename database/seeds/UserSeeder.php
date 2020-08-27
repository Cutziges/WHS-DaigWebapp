<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::firstOrCreate(
            ['email' => 'test@abkatzen.de', 'username' => 'Testuser'],
            [
                'name' => 'Sarah',
                'surname' => 'Grugiel',
                'username' => 'Testuser',
                'email' => 'test@abkatzen.de',
                'password' => bcrypt('1234567890'),
                'type' => 'admin',
            ]
        );
    }
}
