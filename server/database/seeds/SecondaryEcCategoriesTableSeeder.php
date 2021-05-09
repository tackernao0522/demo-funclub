<?php

use Illuminate\Database\Seeder;

class SecondaryEcCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secondary_ec_categories')->delete();
        $secondaryEcCategory_seeds = [
            [
                'id' => 1,
                'name' => 'トップス',
                'sort_no' => 1,
                'primary_ec_category_id' => 1,
            ],
            [
                'id'                  => 2,
                'name'                => 'ジャケット/アウター',
                'sort_no'             => 2,
                'primary_ec_category_id' => 1,
            ],
            [
                'id'                  => 3,
                'name'                => 'パンツ',
                'sort_no'             => 3,
                'primary_ec_category_id' => 1,
            ],
            [
                'id'                  => 4,
                'name'                => 'トップス',
                'sort_no'             => 4,
                'primary_ec_category_id' => 2,
            ],
            [
                'id'                  => 5,
                'name'                => 'ジャケット/アウター',
                'sort_no'             => 5,
                'primary_ec_category_id' => 2,
            ],
            [
                'id'                  => 6,
                'name'                => '靴',
                'sort_no'             => 6,
                'primary_ec_category_id' => 2,
            ],
            [
                'id'                  => 7,
                'name'                => 'ベビー服（男の子用）',
                'sort_no'             => 7,
                'primary_ec_category_id' => 3,
            ],
            [
                'id'                  => 8,
                'name'                => 'ベビー服（女の子用）',
                'sort_no'             => 8,
                'primary_ec_category_id' => 3,
            ],
            [
                'id'                  => 9,
                'name'                => 'キッズ服（男の子用）',
                'sort_no'             => 9,
                'primary_ec_category_id' => 3,
            ],
            [
                'id'                  => 10,
                'name'                => 'キッズ服（女の子用）',
                'sort_no'             => 10,
                'primary_ec_category_id' => 3,
            ],
            [
                'id'                  => 11,
                'name'                => 'その他',
                'sort_no'             => 11,
                'primary_ec_category_id' => 4,
            ],
        ];
        foreach ($secondaryEcCategory_seeds as $secondaryEcCategory) {
            DB::table('secondary_ec_categories')->insert($secondaryEcCategory);
        }
    }
}
