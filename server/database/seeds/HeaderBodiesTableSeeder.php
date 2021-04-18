<?php

use Illuminate\Database\Seeder;

class HeaderBodiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('header_bodies')->insert([
            'body' => 'ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。ヘッダー文が入ります。',
        ]);
    }
}
