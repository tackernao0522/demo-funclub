<?php

use Illuminate\Database\Seeder;

class TopTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('top_titles')->insert([
            'main_title' => "We'll Make Your Day",
            'content' => 'コンテンツ コンテンツ コンテンツ コンテンツ コンテンツ コンテンツ コンテンツ',
        ]);
    }
}
