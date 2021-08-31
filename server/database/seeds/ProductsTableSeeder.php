<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        $products = [
            // レディース
            ['id' => '1', 'brand_id' => '10', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'E HYPHEN WORLD GALLERY-チェック柄フリル半袖カットソー', 'product_slug_name' => 'E-HYPHEN-WORLD-GALLERY-チェック柄フリル半袖カットソー', 'product_code' => 'T-1-2345271', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2000, 'short_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。', 'long_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。スタンダードにアヴァンギャルドさを大胆にMIXした、どこか面白くアレンジの効いたデザインはイーハイフンならでは。', 'product_thambnail' => 'e_hyphen_world_gallery.jpg', 'status' => 1],
            ['id' => '2', 'brand_id' => '11', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'LACOSTE ワンポイント刺繍半袖Tシャツ', 'product_slug_name' => 'LACOSTE-ワンポイント刺繍半袖Tシャツ', 'product_code' => 'T-2-2123456', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2500, 'short_descp' => '1933年に創立したフランスのファッションブランド。', 'long_descp' => 'LACOSTE / ラコステ 創立者は、プルゴルファーだったルネ・ラコステとアンドレ・ジリエ。被服、バッグ、履物、香水、時計、眼鏡などを取り扱い、特にポロシャツのメーカーとして有名です。', 'product_thambnail' => 'lacoste_t_shirs_main.jpg', 'status' => 1],
            ['id' => '3', 'brand_id' => '12', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'ZARA TRF 半袖Tシャツ', 'product_slug_name' => 'ZARA-TRF-半袖Tシャツ', 'product_code' => 'T-3-4980934', 'product_qty' => 200, 'product_tags_name' => 'Tシャツ', 'selling_price' => 3500, 'short_descp' => 'スペイン、ラ・コルーニャ発祥のアパレルブランド。', 'long_descp' => '世界70カ国以上に1500店舗以上を展開しています。革新性と柔軟性を軸として、上質なデザインが魅力です。ZARA TRF以外にもBASIC、collection等様々なラインを展開し、年齢や性別問わず幅広く支持されています。', 'product_thambnail' => 'zara_t_shirt_main.jpg', 'status' => 1],
            ['id' => '4', 'brand_id' => '13', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'ニアコンド Tシャツ フットボールロゴTEE', 'product_slug_name' => 'ニアコンド-Tシャツ-フットボールロゴTEE', 'product_code' => 'T-4-332323', 'product_qty' => 200, 'product_tags_name' => 'ニアコンド', 'selling_price' => 3500, 'short_descp' => '今夏もマストの使えるロゴTシャツ', 'long_descp' => 'ヴィンテージ感のあるプリントを施したフットボールロゴTシャツ。
            定番のロゴTシャツを、淡いくすみカラーで今年らしくアップデートしました。

            切り替えとヘムラインがアクセントになり、さらっと一枚で着こなせます。
            カラーによってプリントに変化を付けたアソートデザインの4色展開。
            モデル身長：171cm 着用サイズ：M(03)。', 'product_thambnail' => 'niko_and_main.jpg', 'status' => 1],
            ['id' => '5', 'brand_id' => '10', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'E HYPHEN WORLD GALLERY-チェック柄フリル半袖カットソー', 'product_slug_name' => 'E-HYPHEN-WORLD-GALLERY-チェック柄フリル半袖カットソー', 'product_code' => 'T-1-2345271', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2000, 'short_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。', 'long_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。スタンダードにアヴァンギャルドさを大胆にMIXした、どこか面白くアレンジの効いたデザインはイーハイフンならでは。', 'product_thambnail' => 'e_hyphen_world_gallery.jpg', 'status' => 1],
            ['id' => '6', 'brand_id' => '11', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'LACOSTE ワンポイント刺繍半袖Tシャツ', 'product_slug_name' => 'LACOSTE-ワンポイント刺繍半袖Tシャツ', 'product_code' => 'T-2-2123456', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2500, 'short_descp' => '1933年に創立したフランスのファッションブランド。', 'long_descp' => 'LACOSTE / ラコステ 創立者は、プルゴルファーだったルネ・ラコステとアンドレ・ジリエ。被服、バッグ、履物、香水、時計、眼鏡などを取り扱い、特にポロシャツのメーカーとして有名です。', 'product_thambnail' => 'lacoste_t_shirs_main.jpg', 'status' => 1],
            ['id' => '7', 'brand_id' => '12', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'ZARA TRF 半袖Tシャツ', 'product_slug_name' => 'ZARA-TRF-半袖Tシャツ', 'product_code' => 'T-3-4980934', 'product_qty' => 200, 'product_tags_name' => 'Tシャツ', 'selling_price' => 3500, 'short_descp' => 'スペイン、ラ・コルーニャ発祥のアパレルブランド。', 'long_descp' => '世界70カ国以上に1500店舗以上を展開しています。革新性と柔軟性を軸として、上質なデザインが魅力です。ZARA TRF以外にもBASIC、collection等様々なラインを展開し、年齢や性別問わず幅広く支持されています。', 'product_thambnail' => 'zara_t_shirt_main.jpg', 'status' => 1],
            ['id' => '8', 'brand_id' => '13', 'category_id' => 1, 'subCategory_id' => 1, 'subSubCategory_id' => 1, 'product_name' => 'ニアコンド Tシャツ フットボールロゴTEE', 'product_slug_name' => 'ニアコンド-Tシャツ-フットボールロゴTEE', 'product_code' => 'T-4-332323', 'product_qty' => 200, 'product_tags_name' => 'ニアコンド', 'selling_price' => 3500, 'short_descp' => '今夏もマストの使えるロゴTシャツ', 'long_descp' => 'ヴィンテージ感のあるプリントを施したフットボールロゴTシャツ。
            定番のロゴTシャツを、淡いくすみカラーで今年らしくアップデートしました。

            切り替えとヘムラインがアクセントになり、さらっと一枚で着こなせます。
            カラーによってプリントに変化を付けたアソートデザインの4色展開。
            モデル身長：171cm 着用サイズ：M(03)。', 'product_thambnail' => 'niko_and_main.jpg', 'status' => 1],
            // メンズ
            ['id' => '9', 'brand_id' => '10', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'E HYPHEN WORLD GALLERY-チェック柄フリル半袖カットソー', 'product_slug_name' => 'E-HYPHEN-WORLD-GALLERY-チェック柄フリル半袖カットソー', 'product_code' => 'T-1-2345271', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2000, 'short_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。', 'long_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。スタンダードにアヴァンギャルドさを大胆にMIXした、どこか面白くアレンジの効いたデザインはイーハイフンならでは。', 'product_thambnail' => 'e_hyphen_world_gallery.jpg', 'status' => 1],
            ['id' => '10', 'brand_id' => '11', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'LACOSTE ワンポイント刺繍半袖Tシャツ', 'product_slug_name' => 'LACOSTE-ワンポイント刺繍半袖Tシャツ', 'product_code' => 'T-2-2123456', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2500, 'short_descp' => '1933年に創立したフランスのファッションブランド。', 'long_descp' => 'LACOSTE / ラコステ 創立者は、プルゴルファーだったルネ・ラコステとアンドレ・ジリエ。被服、バッグ、履物、香水、時計、眼鏡などを取り扱い、特にポロシャツのメーカーとして有名です。', 'product_thambnail' => 'lacoste_t_shirs_main.jpg', 'status' => 1],
            ['id' => '11', 'brand_id' => '12', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'ZARA TRF 半袖Tシャツ', 'product_slug_name' => 'ZARA-TRF-半袖Tシャツ', 'product_code' => 'T-3-4980934', 'product_qty' => 200, 'product_tags_name' => 'Tシャツ', 'selling_price' => 3500, 'short_descp' => 'スペイン、ラ・コルーニャ発祥のアパレルブランド。', 'long_descp' => '世界70カ国以上に1500店舗以上を展開しています。革新性と柔軟性を軸として、上質なデザインが魅力です。ZARA TRF以外にもBASIC、collection等様々なラインを展開し、年齢や性別問わず幅広く支持されています。', 'product_thambnail' => 'zara_t_shirt_main.jpg', 'status' => 1],
            ['id' => '12', 'brand_id' => '13', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'ニアコンド Tシャツ フットボールロゴTEE', 'product_slug_name' => 'ニアコンド-Tシャツ-フットボールロゴTEE', 'product_code' => 'T-4-332323', 'product_qty' => 200, 'product_tags_name' => 'ニアコンド', 'selling_price' => 3500, 'short_descp' => '今夏もマストの使えるロゴTシャツ', 'long_descp' => 'ヴィンテージ感のあるプリントを施したフットボールロゴTシャツ。
            定番のロゴTシャツを、淡いくすみカラーで今年らしくアップデートしました。

            切り替えとヘムラインがアクセントになり、さらっと一枚で着こなせます。
            カラーによってプリントに変化を付けたアソートデザインの4色展開。
            モデル身長：171cm 着用サイズ：M(03)。', 'product_thambnail' => 'niko_and_main.jpg', 'status' => 1],
            ['id' => '13', 'brand_id' => '10', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'E HYPHEN WORLD GALLERY-チェック柄フリル半袖カットソー', 'product_slug_name' => 'E-HYPHEN-WORLD-GALLERY-チェック柄フリル半袖カットソー', 'product_code' => 'T-1-2345271', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2000, 'short_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。', 'long_descp' => 'ヨーロッパカルチャーを意識したトレンド感とアート性をミックスしたスタイルを提案してるブランドです。スタンダードにアヴァンギャルドさを大胆にMIXした、どこか面白くアレンジの効いたデザインはイーハイフンならでは。', 'product_thambnail' => 'e_hyphen_world_gallery.jpg', 'status' => 1],
            ['id' => '14', 'brand_id' => '11', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'LACOSTE ワンポイント刺繍半袖Tシャツ', 'product_slug_name' => 'LACOSTE-ワンポイント刺繍半袖Tシャツ', 'product_code' => 'T-2-2123456', 'product_qty' => 200, 'product_tags_name' => 'レディース', 'selling_price' => 2500, 'short_descp' => '1933年に創立したフランスのファッションブランド。', 'long_descp' => 'LACOSTE / ラコステ 創立者は、プルゴルファーだったルネ・ラコステとアンドレ・ジリエ。被服、バッグ、履物、香水、時計、眼鏡などを取り扱い、特にポロシャツのメーカーとして有名です。', 'product_thambnail' => 'lacoste_t_shirs_main.jpg', 'status' => 1],
            ['id' => '15', 'brand_id' => '12', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'ZARA TRF 半袖Tシャツ', 'product_slug_name' => 'ZARA-TRF-半袖Tシャツ', 'product_code' => 'T-3-4980934', 'product_qty' => 200, 'product_tags_name' => 'Tシャツ', 'selling_price' => 3500, 'short_descp' => 'スペイン、ラ・コルーニャ発祥のアパレルブランド。', 'long_descp' => '世界70カ国以上に1500店舗以上を展開しています。革新性と柔軟性を軸として、上質なデザインが魅力です。ZARA TRF以外にもBASIC、collection等様々なラインを展開し、年齢や性別問わず幅広く支持されています。', 'product_thambnail' => 'zara_t_shirt_main.jpg', 'status' => 1],
            ['id' => '16', 'brand_id' => '13', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'ニアコンド Tシャツ フットボールロゴTEE', 'product_slug_name' => 'ニアコンド-Tシャツ-フットボールロゴTEE', 'product_code' => 'T-4-332323', 'product_qty' => 200, 'product_tags_name' => 'ニアコンド', 'selling_price' => 3500, 'short_descp' => '今夏もマストの使えるロゴTシャツ', 'long_descp' => 'ヴィンテージ感のあるプリントを施したフットボールロゴTシャツ。
            定番のロゴTシャツを、淡いくすみカラーで今年らしくアップデートしました。

            切り替えとヘムラインがアクセントになり、さらっと一枚で着こなせます。
            カラーによってプリントに変化を付けたアソートデザインの4色展開。
            モデル身長：171cm 着用サイズ：M(03)。', 'product_thambnail' => 'niko_and_main.jpg', 'status' => 1],
            ['id' => '17', 'brand_id' => '5', 'category_id' => 2, 'subCategory_id' => 20, 'subSubCategory_id' => 179, 'product_name' => 'ナイキ スポーツウェア 半袖 メンズ AR5005-010 NIKE', 'product_slug_name' => 'ナイキ スポーツウェア 半袖 メンズ AR5005-010 NIKE', 'product_code' => 'N-T-2-989034', 'product_qty' => 200, 'product_tags_name' => 'NIKE', 'selling_price' => 4000, 'short_descp' => '定番コットンの快適な着心地。', 'long_descp' => '定番コットンの快適な着心地。
            胸に定番ロゴをあしらったナイキ スポーツウェア Tシャツは、柔らかいコットンジャージー素材を使用しています。
            ■カラー：010 ( ブラック/ホワイト )
            ■サイズ：S、M、L、XL、2XL
            ■素材：コットン100％
            ■原産国：スリランカ、中国
            ※原産国をお選びいただくことはできません予めご了承ください
            ■特徴：
            洗濯機洗い可能
            ゆったりと楽に着用できるスタンダードフィット
            ※商品画像はサンプルのため、若干の仕様変更がある場合がございます。予めご了承下さい。
            
            
            検索ワード：スポーツウェア Tシャツ 半袖シャツ 半そで 機能Tシャツ', 'product_thambnail' => 'nike_t_shirt_main.jpg', 'status' => 1],
        ];
        DB::table('products')->insert($products);
    }
}
