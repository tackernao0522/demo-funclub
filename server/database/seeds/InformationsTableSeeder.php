<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 8) as $num) {
            DB::table('information')->insert([
                [
                    'info_image_name' => 'menu1.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'info_image_name' => 'menu2.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'info_image_name' => 'menu3.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'info_image_name' => 'menu4.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'info_image_name' => 'menu5.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'info_image_name' => 'menu6.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],          [
                    'info_image_name' => 'menu7.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],          [
                    'info_image_name' => 'menu8.jpg',
                    'created_at' => Carbon::now()->addDay($num),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }
    }
}
