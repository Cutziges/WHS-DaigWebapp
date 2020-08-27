<?php

use Illuminate\Database\Seeder;

class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recommendations')->insert([
            'topic_id' => '1',
            'name' => 'Sarahs Restaurant',
            'description' => 'One of the best restaurants in Gelsenkirchen. You can get the most delicious food here',
            'address' => 'Fakestraße 1, 45886 Gelsenkirchen',
            'website' => 'www.sarahs-restaurant.de',
            'distance' => '1.4',
            'place_image' => 'food1.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '1',
            'name' => 'Barharas',
            'description' => 'Grab a cocktail and relax at Barharas. The owner is very friendly and the cocktails taste great.',
            'address' => 'Fakestraße 2, 45886 Gelsenkirchen',
            'website' => 'www.barharas.de',
            'phone' => '0209 / 123456789',
            'distance' => '2.1',
            'place_image' => 'food2.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '1',
            'name' => 'Roter Palast',
            'description' => 'Very good food and at Friday there is karaoke.',
            'address' => 'Fakestraße 3, 45886 Gelsenkirchen',
            'distance' => '1.7',
            'place_image' => 'food3.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '1',
            'name' => 'Bartastisch',
            'description' => 'Had a huge hangover after my visit but totally worth it.',
            'address' => 'Fakestraße 4, 45886 Gelsenkirchen',
            'phone' => '0209 / 987654321',
            'distance' => '3.2',
            'place_image' => 'food4.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '2',
            'name' => 'Sand Museum',
            'description' => 'Very cool museum where you can see sand figures and more. In summer it has a big installation outside the building.',
            'address' => 'Fakestraße 150, 45886 Gelsenkirchen',
            'website' => 'www.sand-museum-ge.de',
            'distance' => '5.2',
            'place_image' => 'art1.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '2',
            'name' => 'Gesichter von GE',
            'description' => 'Good wall for pictures. There is also a small cafe nearby.',
            'address' => 'Fakestraße 151, 45886 Gelsenkirchen',
            'distance' => '1.9',
            'place_image' => 'art2.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '2',
            'name' => 'Papierkunst Museum',
            'description' => 'Very cool art and a lot of newspaper.',
            'address' => 'Fakestraße 152, 45886 Gelsenkirchen',
            'phone' => '0209 / 233456788',
            'distance' => '2.2',
            'place_image' => 'art3.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '3',
            'name' => 'Sarahs Golfplatz',
            'description' => 'You can rent everything there and have a really good time.',
            'address' => 'Fakestraße 123, 45886 Gelsenkirchen',
            'website' => 'www.sarahs-golfplatz.de',
            'phone' => '0209 / 98762345',
            'distance' => '4.2',
            'place_image' => 'sport1.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '3',
            'name' => 'Fußballplatz Ückendorf',
            'description' => 'You can rent everything there and have a really good time.',
            'address' => 'Fakestraße 124, 45886 Gelsenkirchen',
            'distance' => '3.6',
            'place_image' => 'sport2.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '3',
            'name' => 'Tennisplatz GE',
            'description' => 'Very nice place to play some tennis',
            'address' => 'Fakestraße 125, 45886 Gelsenkirchen',
            'distance' => '5.4',
            'place_image' => 'sport3.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '4',
            'name' => 'Stadtwald',
            'description' => 'So many trees and animals. You can walk there or ride your bike.',
            'address' => 'Fakestraße 99, 45886 Gelsenkirchen',
            'distance' => '2.1',
            'place_image' => 'nature1.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);

        DB::table('recommendations')->insert([
            'topic_id' => '4',
            'name' => 'Mohnfelder',
            'description' => 'Beautiful plants and a very nice view over the city.',
            'address' => 'Fakestraße 100, 45886 Gelsenkirchen',
            'distance' => '4.8',
            'place_image' => 'nature2.jpeg',
            'place_image_path' => '/images/dummy/'
        ]);
    }
}
