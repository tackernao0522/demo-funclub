<?php

use Illuminate\Database\Seeder;

class ReturnOrderProductMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('return_order_methods')->delete();
        $returnOrderMethds = [
            ['id' => '1', 'return_order_method_name' => '返金', 'sort_no' => 1],
            ['id' => '2', 'return_order_method_name' => '商品交換', 'sort_no' => 2],
        ];
        DB::table('return_order_methods')->insert($returnOrderMethds);
    }
}
