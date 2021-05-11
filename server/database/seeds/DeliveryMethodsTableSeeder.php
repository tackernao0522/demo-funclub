<?php

use Illuminate\Database\Seeder;

class DeliveryMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_methods')->delete();
        $delivery_seeds = [
            [
                'id' => 1,
                'name' => '未定',
                'sort_no' => 1,
            ],
            [
                'id' => 2,
                'name' => 'ゆうメール',
                'sort_no' => 2,
            ],
            [
                'id' => 3,
                'name' => 'レターパック',
                'sort_no' => 3,
            ],
            [
                'id' => 4,
                'name' => '普通郵便(定形、定形外)',
                'sort_no' => 4,
            ],
            [
                'id' => 5,
                'name' => 'クロネコヤマト',
                'sort_no' => 5,
            ],
            [
                'id' => 6,
                'name' => '佐川急便',
                'sort_no' => 6,
            ],
            [
                'id' => 7,
                'name' => 'ゆうパック',
                'sort_no' => 7,
            ],
            [
                'id' => 8,
                'name' => 'クリックポスト',
                'sort_no' => 8,
            ],
            [
                'id' => 9,
                'name' => 'ゆうパケット',
                'sort_no' => 9,
            ],
        ];
        foreach ($delivery_seeds as $deliveryMethod) {
            DB::table('delivery_methods')->insert($deliveryMethod);
        }
    }
}
