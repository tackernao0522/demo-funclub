<?php

use Illuminate\Database\Seeder;

class BlogPostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_post_categories')->delete();
        $blogPostCagtegories = [
            ['id' => '1', 'blog_category_name' => 'テクノロジー', 'sort_no' => 1, 'blog_category_slug_name' => 'テクノロジー'],
            ['id' => '2', 'blog_category_name' => '貨財', 'sort_no' => 2, 'blog_category_slug_name' => '貨財'],
            ['id' => '3', 'blog_category_name' => 'ビジネス', 'sort_no' => 3, 'blog_category_slug_name' => 'ビジネス'],
            ['id' => '4', 'blog_category_name' => 'MUSIC', 'sort_no' => 4, 'blog_category_slug_name' => 'MUSIC'],
        ];
        DB::table('blog_post_categories')->insert($blogPostCagtegories);
    }
}
