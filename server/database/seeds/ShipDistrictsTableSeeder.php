<?php

use Illuminate\Database\Seeder;

class ShipDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ship_districts')->delete();
        $districts = [
            ['id' => '1', 'division_id' => 13, 'district_name' => '足立区', 'sort_no' => 1],
            ['id' => '2', 'division_id' => 13, 'district_name' => '調布市', 'sort_no' => 2],
            ['id' => '3', 'division_id' => 12, 'district_name' => '野田市', 'sort_no' => 3],
            ['id' => '4', 'division_id' => 12, 'district_name' => '千葉市', 'sort_no' => 4],
            ['id' => '5', 'division_id' => 14, 'district_name' => '横浜市', 'sort_no' => 5],
            ['id' => '6', 'division_id' => 14, 'district_name' => '川崎市', 'sort_no' => 6],
        ];
        DB::table('ship_districts')->insert($districts);
    }
}
