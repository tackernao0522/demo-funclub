<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_posts')->delete();
        $blogPosts = [
            ['id' => '1', 'category_id' => '1', 'post_blog_title' => 'スペイン語の起業家', 'post_blog_slug' => 'スペイン語の起業家', 'post_blog_image' => 'blog_01.jpg', 'post_blog_details' => '<p>The Belgian Police warned about the&nbsp;<strong>return of the &#39;Joker&#39; virus</strong>&nbsp;, which attacks&nbsp;<strong>Android devices</strong>&nbsp;and hides itself in various&nbsp;<strong>applications</strong>&nbsp;on the&nbsp;<strong>Google Play Store</strong>&nbsp;. This&nbsp;<strong>malware</strong>&nbsp;is capable of subscribing the user to payment services without their authorization and&nbsp;<strong>emptying their bank accounts</strong>&nbsp;without them noticing.</p>

            <p><em>&quot;This malicious program has been detected in eight Play Store applications that Google has suppressed,&quot;</em>&nbsp;say the Belgian authorities in a&nbsp;<a href="https://www.police.be/5998/fr/actualites/attention-le-virus-joker-est-de-retour-dans-lenvironnement-android" rel="follow">statement</a>&nbsp;published this Friday on their website.</p>
            
            <ul>
                <li><strong>It may interest you:&nbsp;<a href="https://www.entrepreneur.com/article/379782" rel="follow" target="_self">Did you get a free ebook for Kindle from Amazon? This new hacking method can access your bank details</a></strong></li>
            </ul>
            
            <p>The&nbsp;<strong>&#39;Joker&#39;&nbsp;<em>malware</em></strong>&nbsp;became famous in 2017 for infecting and robbing its victims by hiding in different applications. Since then, the&nbsp;<strong>Google Play Store</strong>&nbsp;defense systems have removed around&nbsp;<strong>1,700 apps with the &#39;Joker&#39; malware</strong>&nbsp;before they were downloaded by users.</p>
            
            <p>In September 2020, the&nbsp;<strong>&#39;Joker&#39; virus</strong>&nbsp;was found in&nbsp;<strong>24 Android applications</strong>&nbsp;that registered more than&nbsp;<strong>500 thousand downloads</strong>&nbsp;before being removed. It is estimated that that time it affected more than 30 countries including the United States, Brazil and Spain. Through unauthorized subscriptions,&nbsp;<strong>hackers</strong>&nbsp;could steal&nbsp;<strong>up to $ 7</strong>&nbsp;(about 140 Mexican pesos) per subscription weekly, a figure that has most likely increased in recent months.</p>
            
            <h2><strong>How does the Joker virus work in Android apps?</strong></h2>
            
            <p>The&nbsp;<strong>&#39;Joker&#39; Trojan virus</strong>&nbsp;belongs to a family of&nbsp;<strong><em>malware</em></strong>&nbsp;known as&nbsp;<strong>Bread</strong>&nbsp;, whose objective is to&nbsp;<strong>hack cell phone bills</strong>&nbsp;and&nbsp;<strong>authorize operations without</strong>&nbsp;the user&#39;s consent.</p>
            
            <p>Researchers from the cybersecurity company Quick Heal Security Lab, cited in the statement, explain that this virus can&nbsp;<strong>enter text messages</strong>&nbsp;,&nbsp;<strong>contacts</strong>&nbsp;and&nbsp;<strong>other information on the</strong>&nbsp;infected smartphone.</p>
            
            <ul>
                <li><strong>Also read:&nbsp;<a href="https://www.entrepreneur.com/article/368263" rel="follow" target="_self">So you can detect and delete spy apps on your Smartphone</a></strong></li>
            </ul>
            
            <p>What makes this malware more dangerous is its ability to&nbsp;<strong>subscribe the affected Android user to paid services</strong>&nbsp;, usually Premium or the most expensive version, without their prior authorization.</p>
            
            <p>In the beginning, apps infected with&nbsp;<strong>&#39;Joker&#39;</strong>&nbsp;or another<strong>&nbsp;</strong><strong><em>Malware</em></strong>&nbsp;from this family carried out&nbsp;<strong>fraud via SMS</strong>&nbsp;, but then began to attack&nbsp;<strong>online payments</strong>&nbsp;. These two techniques take advantage of the integration of telephone operators with vendors, to facilitate the&nbsp;<strong>payment of services with the mobile bill</strong>&nbsp;. Both require verification of the device, but not the user, thus they manage to automate payments without requiring any user interaction.</p>
            
            <p><em>&quot;You risk a big surprise at the end of the month in your bank account or on your credit card,&quot;</em>&nbsp;said the Belgian police, referring to the&nbsp;<strong>unknown charges</strong>&nbsp;that the victim will see at the end of the month.</p>
            
            <p>In fact, it is very common for those affected by&nbsp;<strong>&#39;Joker&#39; to</strong>&nbsp;become aware of the theft until they review their account statement in detail. This is because the bank does not suspect an apparently &#39;normal&#39; subscription and, generally, the charges are so small that they are not detected as unusual movements, so they do not even send a usage alert to the account holder.</p>
            
            <h2><strong>In which Android apps could the &#39;Joker virus be?</strong></h2>
            
            <p><iframe frameborder="0" height="90" id="google_ads_iframe_/6280/Entrepreneur-in/article_3" name="google_ads_iframe_/6280/Entrepreneur-in/article_3" scrolling="no" title="3rd party ad content" width="728"></iframe></p>
            
            <p>On this occasion, the harmful applications that the&nbsp;<strong>Google Play Store</strong>&nbsp;eliminated after detecting that they contained the&nbsp;<strong>&#39;Joker&#39; virus</strong>&nbsp;are:</p>
            
            <ul>
                <li>Auxiliary Message</li>
                <li>Element Scanner</li>
                <li>Fast Magic SMS</li>
                <li>Free CamScanner</li>
                <li>Go Messages</li>
                <li>Super Message</li>
                <li>Super SMS</li>
                <li>Travel Wallpapers</li>
            </ul>
            
            <p>However, other specialists warn that more&nbsp;<strong>apps are affected</strong>&nbsp;and, therefore, millions of users who do not know that they are already victims of this cyber fraud.</p>
            
            <ul>
                <li><strong>We recommend:&nbsp;<a href="https://www.entrepreneur.com/article/373297" rel="follow" target="_self">Uber, Facebook, Instagram and other apps that are slowly killing your smartphone</a></strong></li>
            </ul>
            
            <p>The cybersecurity company Zscaler, cited by&nbsp;<a href="https://www.larazon.es/tecnologia/20210823/vrx2gosazzactbgp2a2tem6qmm.html" rel="follow">La Raz&oacute;n</a>&nbsp;, made public the names of 16 other apps that, according to their analysis, also contain this malicious code:</p>
            
            <ul>
                <li>Private SMS</li>
                <li>Hummingbird PDF Converter - Photo to PDF</li>
                <li>Style Photo Collage</li>
                <li>Talent Photo Editor - Blur focus</li>
                <li>Paper Doc Scanner</li>
                <li>All Good PDF Scanner</li>
                <li>Care Message</li>
                <li>Part Message</li>
                <li>Blue Scanner</li>
                <li>Direct Messenger</li>
                <li>One Sentence Translator - Multifunctional Translator</li>
                <li>Mint Leaf Message-Your Private Message</li>
                <li>Unique Keyboard - Fancy Fonts &amp; Free Emoticons</li>
                <li>Tangram App Lock</li>
                <li>Desire Translate</li>
                <li>Meticulous Scanner</li>
            </ul>
            
            <p>Of course, the recommendation for Andriod users is to check if they have any of these apps installed on their smartphone and delete them immediately, since the fact that they are deleted from the Google Play Store does not imply automatic uninstallation from the computers where they were downloaded.</p>',
            'created_at' => Carbon::now(),],
            ['id' => '2', 'category_id' => '2', 'post_blog_title' => '24歳でビジネスを売ることがこの起業家に幸福と成功について教えたこと', 'post_blog_slug' => '24歳でビジネスを売ることがこの起業家に幸福と成功について教えたこと', 'post_blog_image' => 'blog_02.png', 'post_blog_details' => '<p>人間は常に階層を作成し、さまざまな要因に基づいて人口を分割することに熱心でした。これらの指標は何年にもわたって変化しており、それでも世界中で大きく異なりますが、その1つはどこに行っても普遍的であり、成功です。</p>

            <p>しかし、どうすれば成功を測定し、比較的正確な結果を期待できますか？何千年にもわたってまったく同じ基準を使用してきたため、答えは単純なようですが、ますます多くの人々が反対し始めています。興味深いことに、それに反対する人々はピラミッドの頂上から話し、私たちがどれほど間違っていたかを私たちに話します。</p>
            
            <p>主要な成功指標<br />
            見知らぬ人を調べて、彼らがどれほど成功しているかを確認したい場合、プロセスは何よりも簡単でなければなりません。インターネットにアクセスすると、人々のソーシャルメディアアカウント、関連するニュース記事、さらには彼らの法的な歴史を確認できます。</p>
            
            <p>私たち自身の欲求と組み合わせることで、このツールは私たちに人々の生活へのユニークな洞察を与え、彼らが完璧な生活がどうあるべきかという私たちのイメージにどれほど似ているかを見ることができます。チェックするメインボックス？富。</p>
            
            <p>関連：これらの15人の非常に成功した人々がどのように幸せで健康を維持するか</p>
            
            <p>幸福の代償<br />
            お金は幸福を買うものではないと人々が言うのを聞いたことがあります。別のグループは、お金がこの追求からあなたを遠ざけるために金持ちが使用するトリックにすぎないと主張しています。とはいえ、銀行口座にすでにゼロの公平なシェアを持っている人からは、ほとんどの場合それを聞くでしょう。それで、誰がここにいますか？</p>
            
            <p>自分の意見を表明する2つの側面に直面した場合、最良のアイデアは、科学が何を言っているかを調べることです。 2017年の調査では、世界中の170万人を超える個人のサンプルを調査して、年間世帯収入が全体的な生活満足度とどのように関連しているかを判断しました。その結果は印象的でした。</p>
            
            <p><br />
            北米の場合、平均寿命評価は収入が増えるにつれて着実に増加しているように見えますが、最終的に105,000ドルに達すると、収入がどれだけ増えても、目に見えるプラトーが現れます。これは調査対象のすべての地域に見られ、収入が増えるにつれて幸福度が低下する地域もあります。</p>
            
            <p>CEOの呪い<br />
            世界の億万長者のリストを見ると、相続人を除いて、事実上すべての億万長者が、彼らがしばしば設立したいくつかの最大の企業を統括していることがわかります。したがって、報酬の一部が2億1,100万ドルにもなることを考えると、彼らの幸福は屋根を通り抜けるはずです。そうではありません。</p>
            
            <p>ハーバードビジネスレビューが実施した調査によると、平均的なCEOは平日1日約9.7時間働いています。さらに、彼らは平日の約79％と休暇の70％を、それぞれ平均3.9時間と2.4時間のビジネスに費やしています。</p>
            
            <p>合計すると、毎週平均62.5時間かかります。見通しを立てると、米国労働統計局によると、平均的なアメリカ人は毎週約34.9時間働いており、これはCEOのカウンターパートの半分近くに相当します。</p>
            
            <p>関連：このCEOが燃え尽き症候群を防ぐために使用する簡単なトリック</p>
            
            <p>バランスを見つける<br />
            しかし、これは幸福と何の関係があるのでしょうか？結局のところ、それらの人々は世界をより良い場所にするためにたゆまぬ努力をしていて、彼らは自分たちのためにこのキャリアを選んだので、どちらかといえば、それは幸せの定義であるべきです。しかし、それは本当にですか？</p>
            
            <p>幸せな生活を送るための3つの主な貢献者は、友人や家族と話したり、音楽を聴いたり、祈りや瞑想をしたりしているようです。 CEOが直面する時間の不足は、仕事をやめてその瞬間を楽しむことを要求する活動にふけることを効果的に妨げます。</p>',
            'created_at' => Carbon::now(),],
            ['id' => '3', 'category_id' => '3', 'post_blog_title' => 'コンサルティング事業を始める方法', 'post_blog_slug' => 'コンサルティング事業を始める方法', 'post_blog_image' => 'blog_03.jpg', 'post_blog_details' => '<p>編集者注：この記事は、起業家書店から入手できるコンサルティングビジネスのスタートアップガイドから抜粋したものです。</p>

            <p>辞書では、コンサルタントを「会社または別の個人のアドバイザーとして働く特定の分野の専門家」と定義しています。かなり曖昧に聞こえますね。しかし、過去10年間昏睡状態に陥っていない限り、コンサルタントとは何かを知っていると思います。</p>
            
            <p>企業は確かにコンサルタントが何であるかを理解しています。 1997年、米国の企業はコンサルティングに120億ドル強を費やしました。カリフォルニア州アーバインにある専門コンサルタント協会のスポークスマンであるアンナフラワーズ氏によると、協会は最近、ビジネスに参入したい人々からの情報を求める声が高まっていることに気づきました。 「市場は[企業向けコンサルティング]の分野に開かれています」とフラワーズ氏は言います。</p>
            
            <p>バージニア州アーリントンの独立コンサルタントであるMelindaP。は、テクノロジーによってコンサルティング分野への参入が容易になったため、より多くの人々がコンサルティング分野に参入していると考えています。 「コンサルタントとして成功するのに役立ったのと同じテクノロジーによって、他の人も同じことを簡単に行えるようになりました」と彼女は言います。</p>
            
            <p>コンサルタントの仕事は相談することです。それ以上でもそれ以下でもありません。とても簡単です。あるコンサルタントを別のコンサルタントよりも成功させる魔法の公式や秘密はありません。</p>
            
            <p>しかし、良いコンサルタントと悪いコンサルタントを区別するのは、卓越性への情熱と意欲です。そして-そうそう-良いコンサルタントは彼または彼女が相談している主題について精通しているべきです。それは違いを生みます。</p>
            
            <p>ほら、この時代では、誰でもコンサルタントになることができます。あなたが発見する必要があるのはあなたの特定の贈り物が何であるかだけです。たとえば、コンピュータの操作に非常に慣れていますか？ほぼ毎日変化しているように見える最新のソフトウェアとハ​​ードウェアの情報についていくのですか？そして、あなたはあなたが得たその知識を取り、誰かがお金を払っても構わないと思っているであろう資源にそれを変えることができますか？そうすれば、コンピュータコンサルタントとして問題なく働くことができます。</p>
            
            <p>それともあなたは資金調達分野の専門家ですか？多分あなたは資金調達、マーケティング、広報または販売の分野で非営利団体で働いていて、何年にもわたってあなたはお金を集める方法を発見しました。資金調達の10年の成功を儲かるコンサルティングビジネスに変えた人として、私は資金調達コンサルティングが確かに成長している産業であるとあなたに言うことができます。</p>', 'created_at' => Carbon::now(),],
            ['id' => '4', 'category_id' => '4', 'post_blog_title' => '10,000ドル未満で開始する63の企業', 'post_blog_slug' => '10,000ドル未満で開始する63の企業', 'post_blog_image' => 'blog_04.jpg', 'post_blog_details' => '<p>あなたはあなたがあなた自身のために何かを始めたいと思っていることを知っています。あなたはただあなたの野心と時間を追加の現金を稼ぎ、あなたを誇りに思い、そしておそらくフルタイムのベンチャーにつながるアイデアに注ぎ込む必要があります。あなたが「私はやめた！」と言うとき、あなたがその驚くべき瞬間を得るならば、さらに良いでしょう。上司に。しかし、どのような素晴らしいアイデアを始めるべきですか？</p>

            <p>育児、修理サービス、パーティーの計画から、ビジネスコンサルティング、職人の製造、履歴書の作成まで、10,000ドル未満で開始できるアイデアのリストには、あらゆるスキルレベル、関心、予算に対応するビジネスがあります。ここにリストされているいくつかのアイデアは、2,000ドル未満で始めることもできます！<br />
            これらの事業は、フルタイムまたはパートタイムで開始できます。あなたの場所はあなたの顧客の家や会社、作業用バンやトラック、小さな店先、あるいは単なるウェブサイトかもしれません。チラシやクーポンを使ってローカルに広告を出したり、潜在的なクライアントにコールドコールしたり、ウェブサイトやオンライン広告キャンペーンを使ってショップを立ち上げたりします。顧客を見つけることは、選択したビジネスアイデアによって異なります。</p>
            
            <p>関連：10,000ドル未満で始めることができる5つの手頃なフランチャイズ</p>
            
            <p>各アイデアには、ビジネスの概要、サービスの提供または製品の作成に必要なスキルレベルの推奨事項、ビジネスのマーケティングのアイデア、および他の人がこの分野で請求している現在の平均料金が含まれます。また、業界団体、Webサイト、書籍など、各ビジネスアイデアのリソースのリストも含まれています。これは、アイデアが情熱を刺激した場合に調査を継続するのに役立ちます。このアイデアのリストにリソースを掲載することは、会社や出版物を推奨するものではありません。彼または彼女が評判の良い組織とビジネスをしていることを確認することは、すべての起業家の責任です。むしろ、これらはアイデアから事業の所有権への旅の最初のリソースにすぎません。</p>
            
            <p>2,000ドル未満のビジネスアイデア<br />
            10,000ドル未満のビジネスアイデア</p>
            
            <p>サービス再開<br />
            サービス再開<br />
            画像クレジット：graphicstock<br />
            2,000ドル未満<br />
            人々の経験、特別なスキル、興味が彼らを仕事の適切な候補者にする理由を説明するのに最適な言葉を見つけることは難しい仕事です。そのため、ほとんどの人が自分で書くためのツール（コンピューターとワードプロセッシングプログラム）を持っているにもかかわらず、履歴書サービスは繁栄し続けています。あなたが人的資源、管理、または管理のバックグラウンドを持つワードスミスである場合、このアイデアはあなたにとって絶好の機会かもしれません。</p>
            
            <p>履歴書サービスを開始するというアイデアの最も優れた点の1つは、自宅で現在のコンピューターを使用して、小規模でパートタイムで開始し、コストを低く抑えることができることです。これは、月に数百ドルの追加収入を求めている人々にとって絶好の機会です。履歴書に加えて、カバーレターやお礼状の作成、LinkedInプロファイルの支援、業界で必要な場合にクライアントがポートフォリオを構築するのを支援するなどのアイデアもあります。履歴書サービスのアイデアを競合他社のアイデアと区別する方法として、面接の服装、ストレスの多い面接状況での対処方法、フォローアップの電話のかけ方、面接の準備方法、および方法についてのコンサルティングを提供することを検討してください。その夢の仕事のためにネットワークに。ローカル、オンライン、およびキャリア博覧会を通じて広告を出します。一度確立されると、口コミ広告と顧客の声は、このビジネスアイデアであなたを忙しくさせるのに大いに役立ちます。</p>
            
            <p>関連：オンラインでビジネスを始める方法</p>
            
            <p>一目で</p>
            
            <p>投資：2,000ドル未満</p>
            
            <p>料金：15ドル以上</p>
            
            <p>スキルレベル：1-2</p>
            
            <p>資力：</p>
            
            <p>全国履歴書作家協会</p>
            
            <p>履歴書作家＆キャリアコーチの専門家協会</p>
            
            <p>MartinYateによるKnock&#39;em Dead Resume Templates（Adams Media、2014）</p>
            
            <p>目立つ履歴書！ L.ザビエルカノ（チェスター出版、2014年）</p>', 'created_at' => Carbon::now(),],
        ];
        DB::table('blog_posts')->insert($blogPosts);
    }
}
