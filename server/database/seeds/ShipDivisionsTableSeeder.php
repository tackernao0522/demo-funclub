<?php

use Illuminate\Database\Seeder;

class ShipDivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ship_divisions')->delete();
        $prefectures = [
            ['id' => '1', 'division_name' => '北海道','sort_no' => 1],
            ['id' => '2', 'division_name' => '青森県', 'sort_no' => 2],
            ['id' => '3', 'division_name' => '岩手県', 'sort_no' => 3],
            ['id' => '4', 'division_name' => '宮城県', 'sort_no' => 4],
            ['id' => '5', 'division_name' => '秋田県', 'sort_no' => 5],
            ['id' => '6', 'division_name' => '山形県', 'sort_no' => 6],
            ['id' => '7', 'division_name' => '福島県', 'sort_no' => 7],
            ['id' => '8', 'division_name' => '茨城県', 'sort_no' => 8],
            ['id' => '9', 'division_name' => '栃木県', 'sort_no' => 9],
            ['id' => '10', 'division_name' => '群馬県', 'sort_no' => 10],
            ['id' => '11', 'division_name' => '埼玉県', 'sort_no' => 11],
            ['id' => '12', 'division_name' => '千葉県', 'sort_no' => 12],
            ['id' => '13', 'division_name' => '東京都', 'sort_no' => 13],
            ['id' => '14', 'division_name' => '神奈川県', 'sort_no' => 14],
            ['id' => '15', 'division_name' => '新潟県', 'sort_no' => 15],
            ['id' => '16', 'division_name' => '富山県', 'sort_no' => 16],
            ['id' => '17', 'division_name' => '石川県', 'sort_no' => 17],
            ['id' => '18', 'division_name' => '福井県', 'sort_no' => 18],
            ['id' => '19', 'division_name' => '山梨県', 'sort_no' => 19],
            ['id' => '20', 'division_name' => '長野県', 'sort_no' => 20],
            ['id' => '21', 'division_name' => '岐阜県', 'sort_no' => 21],
            ['id' => '22', 'division_name' => '静岡県', 'sort_no' => 22],
            ['id' => '23', 'division_name' => '愛知県', 'sort_no' => 23],
            ['id' => '24', 'division_name' => '三重県', 'sort_no' => 24],
            ['id' => '25', 'division_name' => '滋賀県', 'sort_no' => 25],
            ['id' => '26', 'division_name' => '京都府', 'sort_no' => 26],
            ['id' => '27', 'division_name' => '大阪府', 'sort_no' => 27],
            ['id' => '28', 'division_name' => '兵庫県', 'sort_no' => 28],
            ['id' => '29', 'division_name' => '奈良県', 'sort_no' => 29],
            ['id' => '30', 'division_name' => '和歌山県', 'sort_no' => 30],
            ['id' => '31', 'division_name' => '鳥取県', 'sort_no' => 31],
            ['id' => '32', 'division_name' => '島根県', 'sort_no' => 32],
            ['id' => '33', 'division_name' => '岡山県', 'sort_no' => 33],
            ['id' => '34', 'division_name' => '広島県', 'sort_no' => 34],
            ['id' => '35', 'division_name' => '山口県', 'sort_no' => 35],
            ['id' => '36', 'division_name' => '徳島県', 'sort_no' => 36],
            ['id' => '37', 'division_name' => '香川県', 'sort_no' => 37],
            ['id' => '38', 'division_name' => '愛媛県', 'sort_no' => 38],
            ['id' => '39', 'division_name' => '高知県', 'sort_no' => 39],
            ['id' => '40', 'division_name' => '福岡県', 'sort_no' => 40],
            ['id' => '41', 'division_name' => '佐賀県', 'sort_no' => 41],
            ['id' => '42', 'division_name' => '長崎県', 'sort_no' => 42],
            ['id' => '43', 'division_name' => '熊本県', 'sort_no' => 43],
            ['id' => '44', 'division_name' => '大分県', 'sort_no' => 44],
            ['id' => '45', 'division_name' => '宮崎県', 'sort_no' => 45],
            ['id' => '46', 'division_name' => '鹿児島県', 'sort_no' => 46],
            ['id' => '47', 'division_name' => '沖縄県', 'sort_no' => 47],
        ];
        DB::table('ship_divisions')->insert($prefectures);
    }
}
