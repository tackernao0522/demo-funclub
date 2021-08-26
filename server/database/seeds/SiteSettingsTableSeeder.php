<?php

use Illuminate\Database\Seeder;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->delete();
        $siteSettings = [
            [
                'id' => '1',
                'logo' => 'LLzefpG1XLktFftmI53BTknnbNZONBRkPaOjfUIm.png',
                'phone_one' => '048-254-3345',
                'phone_two' => '048-254-3348',
                'email' => 'info@hearts-web.net',
                'company_name' => '西川口Live House Hearts',
                'company_address' => '埼玉県川口市並木２丁目１０−２５ ライブハウスハーツ',
                'facebook' => 'https://www.facebook.com/nishikawaguchihearts/',
                'twitter' => 'https://twitter.com/NK_Hearts',
                'linkedin' => 'https://jp.linkedin.com/',
                'youtube' => 'https://youtu.be/18sZ3EFJ9CU',
            ],
        ];
        DB::table('site_settings')->insert($siteSettings);
    }
}
