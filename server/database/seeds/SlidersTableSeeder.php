<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->delete();
        $brands = [
            ['id' => '1', 'slider_img' => 'slider01.jpg', 'sort_no' => 1],
            ['id' => '2', 'slider_img' => 'slider02.jpg', 'sort_no' => 2],
            ['id' => '3', 'slider_img' => 'slider03.jpg', 'sort_no' => 3],
            ['id' => '4', 'slider_img' => 'slider04.jpg', 'sort_no' => 4],
            ['id' => '5', 'slider_img' => 'slider05.jpg', 'sort_no' => 5],
            ['id' => '6', 'slider_img' => 'slider06.jpg', 'sort_no' => 6],
            ['id' => '7', 'slider_img' => 'slider07.jpg', 'sort_no' => 7],
            ['id' => '8', 'slider_img' => 'slider08.jpg', 'sort_no' => 8],
            ['id' => '9', 'slider_img' => 'slider09.jpg', 'sort_no' => 9],
        ];
        DB::table('sliders')->insert($brands);
    }
}
