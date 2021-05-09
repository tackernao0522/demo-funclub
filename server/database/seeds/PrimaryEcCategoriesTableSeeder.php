<?php

use Illuminate\Database\Seeder;

class PrimaryEcCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_ec_categories')->delete();
        $primaryEcCategory_seeds = [
            [
                'id' => 1,
                'name' => 'レディース',
                'sort_no' => 1,
            ],
            [
                'id'      => 2,
                'name'    => 'メンズ',
                'sort_no' => 2,
            ],
            [
                'id'      => 3,
                'name'    => 'ベビー・キッズ',
                'sort_no' => 3,
            ],
            [
                'id'      => 4,
                'name'    => 'その他',
                'sort_no' => 4,
            ],
        ];
        foreach ($primaryEcCategory_seeds as $primaryEcCategory) {
            DB::table('primary_ec_categories')->insert($primaryEcCategory);
        }
    }
}
