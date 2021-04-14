<?php

use Illuminate\Database\Seeder;
use App\PrimaryCategory;
use Illuminate\Support\Facades\DB;

class PrimaryCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->delete();
        $primaryCategory_seeds = [
            [
                'id' => 1,
                'name' => 'カテゴリー1',
                'sort_no' => 1,
            ],
            [
                'id'      => 2,
                'name'    => 'カテゴリー2',
                'sort_no' => 2,
            ],
            [
                'id'      => 3,
                'name'    => 'カテゴリー3',
                'sort_no' => 3,
            ],
            [
                'id'      => 4,
                'name'    => 'その他',
                'sort_no' => 4,
            ],
        ];
        foreach ($primaryCategory_seeds as $primaryCategory) {
            DB::table('primary_categories')->insert($primaryCategory);
        }
    }
}
