<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(SubTitlesTableSeeder::class);
        $this->call(HeaderBodiesTableSeeder::class);
        $this->call(InformationsTableSeeder::class);
        $this->call(BigImagesTableSeeder::class);
        $this->call(TopTitlesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(ItemConditionTableSeeder::class);
        $this->call(PrimaryEcCategoriesTableSeeder::class);
        $this->call(SecondaryEcCategoriesTableSeeder::class);
        $this->call(ShippingFeePayersTableSeeder::class);
        $this->call(DeliveryMethodsTableSeeder::class);
        $this->call(DeliveryTimesTableSeeder::class);
    }
}
