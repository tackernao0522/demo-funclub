<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
        DB::table('items')->insert([
            [
                'seller_id' => 1,
                'secondary_ec_category_id' => 1,
                'item_condition_id' => 1,
                'shipping_fee_payer_id' => 1,
                'delivery_method_id' => 7,
                'delivery_time_id' => 1,
                'stock' => 5,
                'name' => 'ヴィトン 長財布',
                'item_image_name' => 'image8.jpg',
                'description' => 'ヴィトンの長財布です。新製品です。この機会に是非どうぞ！',
                'price' => 45000,
                'state' => 'selling',
                'created_at' => Carbon::now(),
            ],
            [
                'seller_id' => 1,
                'secondary_ec_category_id' => 2,
                'item_condition_id' => 2,
                'shipping_fee_payer_id' => 2,
                'delivery_method_id' => 6,
                'delivery_time_id' => 2,
                'stock' => 10,
                'name' => 'Tシャツ ブラック',
                'item_image_name' => 'image5.jpg',
                'description' => '新製品のTシャツです。人気商品です。',
                'price' => 3500,
                'state' => 'selling',
                'created_at' => Carbon::now(),
            ],
            [
                'seller_id' => 1,
                'secondary_ec_category_id' => 5,
                'item_condition_id' => 3,
                'shipping_fee_payer_id' => 1,
                'delivery_method_id' => 5,
                'delivery_time_id' => 3,
                'stock' => 6,
                'name' => 'シャネル ファンデーション',
                'item_image_name' => 'image20.jpg',
                'description' => '今、大人気の商品です。早い者勝ちです。急いでどうぞ！',
                'price' => 15000,
                'state' => 'selling',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
