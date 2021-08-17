<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->delete();
        $subCategories = [
            // レディースサブ
            ['id' => '1', 'category_id' => '1', 'subCategory_name' => 'トップス', 'subCategory_slug_name' => 'トップス', 'sort_no' => 1],
            ['id' => '2', 'category_id' => '1', 'subCategory_name' => 'ジャケット/アウター', 'subCategory_slug_name' => 'ジャケット/アウター', 'sort_no' => 2],
            ['id' => '3', 'category_id' => '1', 'subCategory_name' => 'パンツ', 'subCategory_slug_name' => 'パンツ', 'sort_no' => 3],
            ['id' => '4', 'category_id' => '1', 'subCategory_name' => 'スカート', 'subCategory_slug_name' => 'スカート', 'sort_no' => 4],
            ['id' => '5', 'category_id' => '1', 'subCategory_name' => 'ワンピース', 'subCategory_slug_name' => 'ワンピース', 'sort_no' => 5],
            ['id' => '6', 'category_id' => '1', 'subCategory_name' => '靴', 'subCategory_slug_name' => '靴', 'sort_no' => 6],
            ['id' => '7', 'category_id' => '1', 'subCategory_name' => 'ルームウェア/パジャマ', 'subCategory_slug_name' => 'ルームウェア/パジャマ', 'sort_no' => 7],
            ['id' => '8', 'category_id' => '1', 'subCategory_name' => 'レッグウェア', 'subCategory_slug_name' => 'レッグウェア', 'sort_no' => 8],
            ['id' => '9', 'category_id' => '1', 'subCategory_name' => '帽子', 'subCategory_slug_name' => '帽子', 'sort_no' => 9],
            ['id' => '10', 'category_id' => '1', 'subCategory_name' => 'バッグ', 'subCategory_slug_name' => 'バッグ', 'sort_no' => 10],
            ['id' => '11', 'category_id' => '1', 'subCategory_name' => 'アクセサリー', 'subCategory_slug_name' => 'アクセサリー', 'sort_no' => 11],
            ['id' => '12', 'category_id' => '1', 'subCategory_name' => 'ヘアアクセサリー', 'subCategory_slug_name' => 'ヘアアクセサリー', 'sort_no' => 12],
            ['id' => '13', 'category_id' => '1', 'subCategory_name' => '小物', 'subCategory_slug_name' => '小物', 'sort_no' => 13],
            ['id' => '14', 'category_id' => '1', 'subCategory_name' => '時計', 'subCategory_slug_name' => '時計', 'sort_no' => 14],
            ['id' => '15', 'category_id' => '1', 'subCategory_name' => 'ウィッグ/エクステ', 'subCategory_slug_name' => 'ウィッグ/エクステ', 'sort_no' => 15],
            ['id' => '16', 'category_id' => '1', 'subCategory_name' => '浴衣/水着', 'subCategory_slug_name' => '浴衣/水着', 'sort_no' => 16],
            ['id' => '17', 'category_id' => '1', 'subCategory_name' => 'スーツ/フォーマル/ドレス', 'subCategory_slug_name' => 'スーツ/フォーマル/ドレス', 'sort_no' => 17],
            ['id' => '18', 'category_id' => '1', 'subCategory_name' => 'マタニティ', 'subCategory_slug_name' => 'マタニティ', 'sort_no' => 18],
            ['id' => '19', 'category_id' => '1', 'subCategory_name' => 'その他', 'subCategory_slug_name' => 'その他', 'sort_no' => 19],
            // メンズサブ
            ['id' => '20', 'category_id' => '2', 'subCategory_name' => 'トップス', 'subCategory_slug_name' => 'トップス', 'sort_no' => 20],
            ['id' => '21', 'category_id' => '2', 'subCategory_name' => 'ジャケット/アウター', 'subCategory_slug_name' => 'ジャケット/アウター', 'sort_no' => 21],
            ['id' => '22', 'category_id' => '2', 'subCategory_name' => 'パンツ', 'subCategory_slug_name' => 'パンツ', 'sort_no' => 22],
            ['id' => '23', 'category_id' => '2', 'subCategory_name' => '靴', 'subCategory_slug_name' => '靴', 'sort_no' => 23],
            ['id' => '24', 'category_id' => '2', 'subCategory_name' => 'バッグ', 'subCategory_slug_name' => 'バッグ', 'sort_no' => 24],
            ['id' => '25', 'category_id' => '2', 'subCategory_name' => 'スーツ', 'subCategory_slug_name' => 'スーツ', 'sort_no' => 25],
            ['id' => '26', 'category_id' => '2', 'subCategory_name' => '帽子', 'subCategory_slug_name' => '帽子', 'sort_no' => 26],
            ['id' => '27', 'category_id' => '2', 'subCategory_name' => 'アクセサリー', 'subCategory_slug_name' => 'アクセサリー', 'sort_no' => 27],
            ['id' => '28', 'category_id' => '2', 'subCategory_name' => '小物', 'subCategory_slug_name' => '小物', 'sort_no' => 28],
            ['id' => '29', 'category_id' => '2', 'subCategory_name' => '時計', 'subCategory_slug_name' => '時計', 'sort_no' => 29],
            ['id' => '30', 'category_id' => '2', 'subCategory_name' => '水着', 'subCategory_slug_name' => '水着', 'sort_no' => 30],
            ['id' => '31', 'category_id' => '2', 'subCategory_name' => 'レッグウェア', 'subCategory_slug_name' => 'レッグウェア', 'sort_no' => 31],
            ['id' => '32', 'category_id' => '2', 'subCategory_name' => 'アンダーウェア', 'subCategory_slug_name' => 'アンダーウェア', 'sort_no' => 32],
            ['id' => '33', 'category_id' => '2', 'subCategory_name' => 'その他', 'subCategory_slug_name' => 'その他', 'sort_no' => 33],
            // ベビー・キッズサブ
            ['id' => '34', 'category_id' => '3', 'subCategory_name' => 'ベビー服(女の子用) ~95cm', 'subCategory_slug_name' => 'ベビー服(女の子用) ~95cm', 'sort_no' => 34],
            ['id' => '35', 'category_id' => '3', 'subCategory_name' => 'ベビー服(男の子用) ~95cm', 'subCategory_slug_name' => 'ベビー服(男の子用) ~95cm', 'sort_no' => 35],
            ['id' => '36', 'category_id' => '3', 'subCategory_name' => 'ベビー服(男女兼用) ~95cm', 'subCategory_slug_name' => 'ベビー服(男女兼用) ~95cm', 'sort_no' => 36],
            ['id' => '37', 'category_id' => '3', 'subCategory_name' => 'キッズ服(女の子用) 100cm~', 'subCategory_slug_name' => 'キッズ服(女の子用) 100cm~', 'sort_no' => 37],
            ['id' => '38', 'category_id' => '3', 'subCategory_name' => 'キッズ服(男の子用) 100cm~', 'subCategory_slug_name' => 'キッズ服(男の子用) 100cm~', 'sort_no' => 38],
            ['id' => '39', 'category_id' => '3', 'subCategory_name' => 'キッズ服(男女兼用) 100cm~', 'subCategory_slug_name' => 'キッズ服(男女兼用) 100cm~', 'sort_no' => 39],
            ['id' => '40', 'category_id' => '3', 'subCategory_name' => 'キッズ靴', 'subCategory_slug_name' => 'キッズ靴', 'sort_no' => 40],
            ['id' => '41', 'category_id' => '3', 'subCategory_name' => '子ども用ファッション小物', 'subCategory_slug_name' => '子ども用ファッション小物', 'sort_no' => 41],
            ['id' => '42', 'category_id' => '3', 'subCategory_name' => 'おむつ/トイレ/バス', 'subCategory_slug_name' => 'おむつ/トイレ/バス', 'sort_no' => 42],
            ['id' => '43', 'category_id' => '3', 'subCategory_name' => '外出/移動用品', 'subCategory_slug_name' => '外出/移動用品', 'sort_no' => 43],
            ['id' => '44', 'category_id' => '3', 'subCategory_name' => '授乳/食事', 'subCategory_slug_name' => '授乳/食事', 'sort_no' => 44],
            ['id' => '45', 'category_id' => '3', 'subCategory_name' => 'ベビー家具/寝具/室内用品', 'subCategory_slug_name' => 'ベビー家具/寝具/室内用品', 'sort_no' => 45],
            ['id' => '46', 'category_id' => '3', 'subCategory_name' => 'おもちゃ', 'subCategory_slug_name' => 'おもちゃ', 'sort_no' => 46],
            ['id' => '47', 'category_id' => '3', 'subCategory_name' => '行事/記念品', 'subCategory_slug_name' => '行事/記念品', 'sort_no' => 47],
            ['id' => '48', 'category_id' => '3', 'subCategory_name' => 'その他', 'subCategory_slug_name' => 'その他', 'sort_no' => 48],
        ];
        DB::table('sub_categories')->insert($subCategories);
    }
}
