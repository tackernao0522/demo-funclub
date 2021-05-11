<?php

use Illuminate\Database\Seeder;

class DeliveryTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_times')->delete();
        $deliveryTime_seeds = [
            [
                'id' => 1,
                'name' => '1~2日で発送',
                'sort_no' => 1,
            ],
            [
                'id' => 2,
                'name' => '2~3日で発送',
                'sort_no' => 2,
            ],
            [
                'id' => 3,
                'name' => '4~7日で発送',
                'sort_no' => 3,
            ],
        ];
        foreach ($deliveryTime_seeds as $deliveryTime) {
            DB::table('delivery_times')->insert($deliveryTime);
        }
    }
}
