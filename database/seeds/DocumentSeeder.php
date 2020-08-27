<?php

use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '1',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 2',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '1',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 3',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '1',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '2',
        ]);
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '3',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 2',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '3',
        ]);
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '4',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 2',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '4',
        ]);
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '5',
        ]);
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '6',
        ]);
        DB::table('documents')->insert([
            'title' => 'Dummy 1',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '7',
        ]);

        DB::table('documents')->insert([
            'title' => 'Dummy 2',
            'file' => 'pdffile.pdf',
            'file_path' => '/images/dummy/',
            'item_id' => '7',
        ]);
    }
}
