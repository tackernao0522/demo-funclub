<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        foreach (range(1, 3) as $num) {
            DB::table('posts')->insert([
                [
                    'post_title' => 'タイトルが入ります。タイトルが入ります。',
                    'primary_category_id' => 1,
                    'post_image_name' => 'monkey_base.jpg',
                    'body' => '説明が入ります、説明が入ります。
                    説明が入ります。説明が入ります。説明が入ります。
                    説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。。
                    説明が入ります。説明が入ります。',
                    'post_date' => Carbon::now()->addDay($num),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'post_title' => 'タイトルが入ります。タイトルが入ります。',
                    'primary_category_id' => 2,
                    'post_image_name' => 'piano_live.jpg',
                    'body' => '説明が入ります、説明が入ります。
                    説明が入ります。説明が入ります。説明が入ります。
                    説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。。
                    説明が入ります。説明が入ります。',
                    'post_date' => Carbon::now()->addDay($num),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'post_title' => 'タイトルが入ります。タイトルが入ります。',
                    'primary_category_id' => 3,
                    'post_image_name' => 'guitar_live.jpg',
                    'body' => '説明が入ります、説明が入ります。
                    説明が入ります。説明が入ります。説明が入ります。
                    説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。。
                    説明が入ります。説明が入ります。',
                    'post_date' => Carbon::now()->addDay($num),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'post_title' => 'タイトルが入ります。タイトルが入ります。',
                    'primary_category_id' => 4,
                    'post_image_name' => 'guitar_live.jpg',
                    'body' => '説明が入ります、説明が入ります。
                    説明が入ります。説明が入ります。説明が入ります。
                    説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。 説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。説明が入ります。。
                    説明が入ります。説明が入ります。',
                    'post_date' => Carbon::now()->addDay($num),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        }
    }
}
