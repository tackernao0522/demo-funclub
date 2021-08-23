<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->delete();
        $coupons = [
            ['id' => '1', 'coupon_name' => 'SUMMER SALE', 'coupon_discount' => 20, 'coupon_validity' => '2021-08-31'],
            ['id' => '2', 'coupon_name' => 'MEMBERS COUPON', 'coupon_discount' => 15, 'coupon_validity' => '2021-09-30'],
            ['id' => '3', 'coupon_name' => 'CHRISTMAS SALE', 'coupon_discount' => 25, 'coupon_validity' => '2021-12-25'],
            ['id' => '4', 'coupon_name' => 'HAPPY NEW YEAR', 'coupon_discount' => 30, 'coupon_validity' => '2022-01-07'],
        ];
        DB::table('coupons')->insert($coupons);
    }
}
