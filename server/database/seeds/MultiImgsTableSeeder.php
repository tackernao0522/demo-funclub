<?php

use Illuminate\Database\Seeder;

class MultiImgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('multi_imgs')->delete();
        $multiImgs = [
            // レディース
            ['id' => '1', 'product_id' => 1, 'photo_name' => 'e_hyphen_world_gallery_01.jpg'],
            ['id' => '2', 'product_id' => 1, 'photo_name' => 'e_hyphen_world_gallery_02.jpg'],
            ['id' => '3', 'product_id' => 2, 'photo_name' => 'lacoste_t_shirs_01.jpg'],
            ['id' => '4', 'product_id' => 2, 'photo_name' => 'lacoste_t_shirs_02.jpg'],
            ['id' => '5', 'product_id' => 3, 'photo_name' => 'zara_t_shirt_01.jpg'],
            ['id' => '6', 'product_id' => 3, 'photo_name' => 'zara_t_shirt_02.jpg'],
            ['id' => '7', 'product_id' => 4, 'photo_name' => 'niko_and_01.jpg'],
            ['id' => '8', 'product_id' => 4, 'photo_name' => 'niko_and_02.jpg'],
            ['id' => '9', 'product_id' => 4, 'photo_name' => 'niko_and_03.jpg'],
            ['id' => '10', 'product_id' => 5, 'photo_name' => 'e_hyphen_world_gallery_01.jpg'],
            ['id' => '11', 'product_id' => 5, 'photo_name' => 'e_hyphen_world_gallery_02.jpg'],
            ['id' => '12', 'product_id' => 6, 'photo_name' => 'lacoste_t_shirs_01.jpg'],
            ['id' => '13', 'product_id' => 6, 'photo_name' => 'lacoste_t_shirs_02.jpg'],
            ['id' => '14', 'product_id' => 7, 'photo_name' => 'zara_t_shirt_01.jpg'],
            ['id' => '15', 'product_id' => 7, 'photo_name' => 'zara_t_shirt_02.jpg'],
            ['id' => '16', 'product_id' => 8, 'photo_name' => 'niko_and_01.jpg'],
            ['id' => '17', 'product_id' => 8, 'photo_name' => 'niko_and_02.jpg'],
            ['id' => '18', 'product_id' => 8, 'photo_name' => 'niko_and_03.jpg'],
            // メンズ
            ['id' => '19', 'product_id' => 9, 'photo_name' => 'e_hyphen_world_gallery_01.jpg'],
            ['id' => '20', 'product_id' => 9, 'photo_name' => 'e_hyphen_world_gallery_02.jpg'],
            ['id' => '21', 'product_id' => 10, 'photo_name' => 'lacoste_t_shirs_01.jpg'],
            ['id' => '22', 'product_id' => 10, 'photo_name' => 'lacoste_t_shirs_02.jpg'],
            ['id' => '23', 'product_id' => 11, 'photo_name' => 'zara_t_shirt_01.jpg'],
            ['id' => '24', 'product_id' => 11, 'photo_name' => 'zara_t_shirt_02.jpg'],
            ['id' => '25', 'product_id' => 12, 'photo_name' => 'niko_and_01.jpg'],
            ['id' => '26', 'product_id' => 12, 'photo_name' => 'niko_and_02.jpg'],
            ['id' => '27', 'product_id' => 12, 'photo_name' => 'niko_and_03.jpg'],
            ['id' => '28', 'product_id' => 13, 'photo_name' => 'e_hyphen_world_gallery_01.jpg'],
            ['id' => '29', 'product_id' => 13, 'photo_name' => 'e_hyphen_world_gallery_02.jpg'],
            ['id' => '30', 'product_id' => 14, 'photo_name' => 'lacoste_t_shirs_01.jpg'],
            ['id' => '31', 'product_id' => 14, 'photo_name' => 'lacoste_t_shirs_02.jpg'],
            ['id' => '32', 'product_id' => 15, 'photo_name' => 'zara_t_shirt_01.jpg'],
            ['id' => '33', 'product_id' => 15, 'photo_name' => 'zara_t_shirt_02.jpg'],
            ['id' => '34', 'product_id' => 16, 'photo_name' => 'niko_and_01.jpg'],
            ['id' => '35', 'product_id' => 16, 'photo_name' => 'niko_and_02.jpg'],
            ['id' => '36', 'product_id' => 16, 'photo_name' => 'niko_and_03.jpg'],
            ['id' => '37', 'product_id' => 17, 'photo_name' => 'nike_t_shirt_01.jpg'],
            ['id' => '38', 'product_id' => 17, 'photo_name' => 'nike_t_shirt_02.jpg'],
            ['id' => '39', 'product_id' => 17, 'photo_name' => 'nike_t_shirt_03.jpg'],
            ['id' => '40', 'product_id' => 17, 'photo_name' => 'nike_t_shirt_04.jpg'],
            ['id' => '41', 'product_id' => 17, 'photo_name' => 'nike_t_shirt_05.jpg'],
        ];
        DB::table('multi_imgs')->insert($multiImgs);
    }
}
