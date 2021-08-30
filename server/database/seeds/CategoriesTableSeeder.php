<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        $categories = [
            ['id' => '1', 'category_name' => 'レディース', 'category_slug_name' => 'レディース', 'sort_no' => 1, 'category_icon' => 'fa fa-female'],
            ['id' => '2', 'category_name' => 'メンズ', 'category_slug_name' => 'メンズ', 'sort_no' => 2, 'category_icon' => 'fa fa-male'],
            ['id' => '3', 'category_name' => 'ベビー・キッズ', 'category_slug_name' => 'ベビー・キッズ', 'sort_no' => 3, 'category_icon' => 'fa fa-child'],
            ['id' => '4', 'category_name' => 'インテリア・住まい・小物', 'category_slug_name' => 'インテリア・住まい・小物', 'sort_no' => 4, 'category_icon' => 'fa fa-home'],
            ['id' => '5', 'category_name' => '本・音楽・ゲーム', 'category_slug_name' => '本・音楽・ゲーム', 'sort_no' => 5, 'category_icon' => 'fa fa-music'],
            ['id' => '6', 'category_name' => 'おもちゃ・ホビー・グッズ', 'category_slug_name' => 'おもちゃ・ホビー・グッズ', 'sort_no' => 6, 'category_icon' => 'fa fa-magic'],
            ['id' => '7', 'category_name' => 'コスメ・香水・美容', 'category_slug_name' => 'コスメ・香水・美容', 'sort_no' => 7, 'category_icon' => 'fa fa-heart'],
            ['id' => '8', 'category_name' => '家電・スマホ・カメラ', 'category_slug_name' => '家電・スマホ・カメラ', 'sort_no' => 8, 'category_icon' => 'fa fa-mobile'],
            ['id' => '9', 'category_name' => 'スポーツ・レジャー', 'category_slug_name' => 'スポーツ・レジャー', 'sort_no' => 9, 'category_icon' => 'fa fa-bicycle'],
            ['id' => '10', 'category_name' => 'ハンドメイド', 'category_slug_name' => 'ハンドメイド', 'sort_no' => 10, 'category_icon' => 'fa fa-gift'],
            ['id' => '11', 'category_name' => 'チケット', 'category_slug_name' => 'チケット', 'sort_no' => 11, 'category_icon' => 'fa fa-ticket'],
            ['id' => '12', 'category_name' => '自動車・オートバイ', 'category_slug_name' => '自動車・オートバイ', 'sort_no' => 12, 'category_icon' => 'fa fa-car'],
            ['id' => '13', 'category_name' => 'その他', 'category_slug_name' => 'その他', 'sort_no' => 13, 'category_icon' => 'fa fa-cube'],
        ];
        DB::table('categories')->insert($categories);
    }
}
