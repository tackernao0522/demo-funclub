<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->delete();
        $brands = [
            ['id' => '1', 'brand_name' => 'ADIDAS', 'sort_no' => 1, 'brand_slug_name' => 'ADIDAS', 'brand_image' => 'adidas.jpg'],
            ['id' => '2', 'brand_name' => 'APPLE', 'sort_no' => 2, 'brand_slug_name' => 'APPLE', 'brand_image' => 'apple.jpg'],
            ['id' => '3', 'brand_name' => 'CHANEL', 'sort_no' => 3, 'brand_slug_name' => 'CHANEL', 'brand_image' => 'chanel.jpg'],
            ['id' => '4', 'brand_name' => 'LOUIS VUITTON', 'sort_no' => 4, 'brand_slug_name' => 'LOUIS-VUITTON', 'brand_image' => 'louisvuitton.jpg'],
            ['id' => '5', 'brand_name' => 'NIKE', 'sort_no' => 5, 'brand_slug_name' => 'NIKE', 'brand_image' => 'nike.png'],
            ['id' => '6', 'brand_name' => 'OPPO', 'sort_no' => 6, 'brand_slug_name' => 'OPPO', 'brand_image' => 'oppo.png'],
            ['id' => '7', 'brand_name' => 'SONY', 'sort_no' => 7, 'brand_slug_name' => 'SONY', 'brand_image' => 'sony.jpg'],
            ['id' => '8', 'brand_name' => 'Supereme', 'sort_no' => 8, 'brand_slug_name' => 'Supereme', 'brand_image' => 'supereme.jpg'],
            ['id' => '9', 'brand_name' => 'VIVO', 'sort_no' => 9, 'brand_slug_name' => 'VIVO', 'brand_image' => 'vivo.png'],
        ];
        DB::table('brands')->insert($brands);
    }
}