<?php

use Illuminate\Database\Seeder;

class ShippingFeePayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_fee_payers')->delete();
        $shipping_fee_payer_seeds = [
            [
                'id' => 1,
                'name' => '送料無料',
                'sort_no' => 1,
            ],
            [
                'id' => 2,
                'name' => '着払い',
                'sort_no' => 2,
            ],
        ];
        foreach ($shipping_fee_payer_seeds as $shipping_fee_payer) {
            DB::table('shipping_fee_payers')->insert($shipping_fee_payer);
        }
    }
}
