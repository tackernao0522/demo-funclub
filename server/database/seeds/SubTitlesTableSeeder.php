<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_titles')->insert([
            'sub_title' => 'サブタイトル',
            'description' => '説明が入ります。説明が入ります。、説明が入ります。。説明が入ります。説明が入ります。
            説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。',
        ]);
    }
}
