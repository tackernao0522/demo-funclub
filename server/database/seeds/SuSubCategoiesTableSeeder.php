<?php

use Illuminate\Database\Seeder;

class SuSubCategoiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_sub_categories')->delete();
        $subSubCategories = [
            // レディース/トップス
            ['id' => '1', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'Tシャツ/カットソー(半袖/袖なし)', 'subSubCategory_slug_name' => 'Tシャツ/カットソー(半袖/袖なし)', 'sort_no' => 1],
            ['id' => '2', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'Tシャツ/カットソー(七分/長袖)', 'subSubCategory_slug_name' => 'Tシャツ/カットソー(七分/長袖)', 'sort_no' => 2],
            ['id' => '3', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'シャツ/ブラウス(半袖/袖なし)', 'subSubCategory_slug_name' => 'シャツ/ブラウス(半袖/袖なし)', 'sort_no' => 3],
            ['id' => '4', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'シャツ/ブラウス(七分/長袖)', 'subSubCategory_slug_name' => 'シャツ/ブラウス(七分/長袖)', 'sort_no' => 4],
            ['id' => '5', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ポロシャツ', 'subSubCategory_slug_name' => 'ポロシャツ', 'sort_no' => 5],
            ['id' => '6', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'キャミソール', 'subSubCategory_slug_name' => 'キャミソール', 'sort_no' => 6],
            ['id' => '7', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'タンクトップ', 'subSubCategory_slug_name' => 'タンクトップ', 'sort_no' => 7],
            ['id' => '8', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ホルターネック', 'subSubCategory_slug_name' => 'ホルターネック', 'sort_no' => 8],
            ['id' => '9', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ニット/セーター', 'subSubCategory_slug_name' => 'ニット/セーター', 'sort_no' => 9],
            ['id' => '10', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'チュニック', 'subSubCategory_slug_name' => 'チュニック', 'sort_no' => 10],
            ['id' => '11', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'カーディガン/ボレロ', 'subSubCategory_slug_name' => 'カーディガン/ボレロ', 'sort_no' => 11],
            ['id' => '12', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'アンサンブル', 'subSubCategory_slug_name' => 'アンサンブル', 'sort_no' => 12],
            ['id' => '13', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ベスト/ジレ', 'subSubCategory_slug_name' => 'ベスト/ジレ', 'sort_no' => 13],
            ['id' => '14', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'パーカー', 'subSubCategory_slug_name' => 'パーカー', 'sort_no' => 14],
            ['id' => '15', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'トレーナー/スウェット', 'subSubCategory_slug_name' => 'トレーナー/スウェット', 'sort_no' => 15],
            ['id' => '16', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ベアトップ/チューブトップ', 'subSubCategory_slug_name' => 'ベアトップ/チューブトップ', 'sort_no' => 16],
            ['id' => '17', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'ジャージ', 'subSubCategory_slug_name' => 'ジャージ', 'sort_no' => 17],
            ['id' => '18', 'category_id' => '1', 'subCategory_id' => '1', 'subSubCategory_name' => 'その他', 'subSubCategory_slug_name' => 'その他', 'sort_no' => 18],
            // レディース/ジャケット/アウター
            ['id' => '19', 'category_id' => '1', 'subCategory_id' => '2', 'subSubCategory_name' => 'テーラードジャケット', 'subSubCategory_slug_name' => 'テーラードジャケット', 'sort_no' => 19],
            ['id' => '20', 'category_id' => '1', 'subCategory_id' => '2', 'subSubCategory_name' => 'ノーカラージャケット', 'subSubCategory_slug_name' => 'ノーカラージャケット', 'sort_no' => 20],
            ['id' => '21', 'category_id' => '1', 'subCategory_id' => '2', 'subSubCategory_name' => 'Gジャン/デニムジャケット', 'subSubCategory_slug_name' => 'Gジャン/デニムジャケット', 'sort_no' => 21],
            ['id' => '22', 'category_id' => '1', 'subCategory_id' => '2', 'subSubCategory_name' => 'レザージャケット', 'subSubCategory_slug_name' => 'レザージャケット', 'sort_no' => 22],
        ];
        DB::table('sub_sub_categories')->insert($subSubCategories);
    }
}
