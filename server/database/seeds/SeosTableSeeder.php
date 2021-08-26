<?php

use Illuminate\Database\Seeder;

class SeosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seos')->delete();
        $seos = [
            [
                'id' => '1',
                'meta_title' => 'しゅうちゃんバンドファンクラブサイト オンラインショップ',
                'meta_author' => 'しゅうちゃんバンド',
                'meta_keyword' => 'しゅうちゃんバンド, オンラインショップ, ファンクラブサイト',
                'meta_description' => 'しゅうちゃんバンドファンクラブサイトです。オンラインショップの商品も充実しています。',
                'google_analytics' => "window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'UA-84816806-1');",
            ],
        ];
        DB::table('seos')->insert($seos);
    }
}
