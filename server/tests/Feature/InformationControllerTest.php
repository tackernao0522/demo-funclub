<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\BigImage;
use App\HeaderBody;
use App\User;
use App\Information;
use HeaderBodiesTableSeeder;
use InformationsTableSeeder;
use BigImagesTableSeeder;

use Tests\TestCase;

class InformationControllerTest extends TestCase
{
    use RefreshDatabase;

    // 未ログイン時にInfor詳細にアクセスするとログイン画面にリダイレクトする
    public function testGuestUserInfoShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(InformationsTableSeeder::class);
        $information = Information::where('id', 1)->first();

        $response = $this->get(route('information.show', ['header_body' => $header_body, 'information' => $information]));

        $response->assertRedirect('login');
    }

    // AdminがInfoの続きを読むにアクセスすると遷移する
    public function testAdminInfoShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(InformationsTableSeeder::class);
        $information = Information::where('id', 1)->first();

        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('information.show', ['header_body' => $header_body, 'information' => $information]));

        $response->assertStatus(200)
            ->assertViewIs('informations.show');
    }

    // PremiumがInfoの続きを読むにアクセスすると遷移する
    public function testPremiumInfoShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(InformationsTableSeeder::class);
        $information = Information::where('id', 1)->first();

        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('information.show', ['header_body' => $header_body, 'information' => $information]));

        $response->assertStatus(200)
            ->assertViewIs('informations.show');
    }

    // MemberがInfoの続きを読むにアクセスするとステータス302が返される
    public function testMemberInfoShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(InformationsTableSeeder::class);
        $information = Information::where('id', 1)->first();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('information.show', ['header_body' => $header_body, 'information' => $information]));

        $response->assertStatus(302);
    }

    // 未ログイン時にメインInfor詳細にアクセスするとログイン画面にリダイレクトする
    public function testGuestUserBigShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(BigImagesTableSeeder::class);
        $big_image = BigImage::where('id', 1)->first();

        $response = $this->get(route('bigInfo.show', ['header_body' => $header_body, 'big_image' => $big_image]));

        $response->assertRedirect('login');
    }

    // AdminがメインInfoの続きを読むにアクセスすると遷移する
    public function testAdminBigShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(BigImagesTableSeeder::class);
        $big_image = BigImage::where('id', 1)->first();

        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('bigInfo.show', ['header_body' => $header_body, 'big_image' => $big_image]));

        $response->assertStatus(200)
            ->assertViewIs('informations.big_show');
    }

    // PremiumがメインInfoの続きを読むにアクセスすると遷移する
    public function testPremiumBigShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(BigImagesTableSeeder::class);
        $big_image = BigImage::where('id', 1)->first();

        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('bigInfo.show', ['header_body' => $header_body, 'big_image' => $big_image]));

        $response->assertStatus(200)
            ->assertViewIs('informations.big_show');
    }

    // MemberがInfoの続きを読むにアクセスするとステータス302が返される
    public function testMemberBigShow()
    {
        $this->seed(HeaderBodiesTableSeeder::class);
        $header_body = HeaderBody::where('id', 1)->first();

        $this->seed(BigImagesTableSeeder::class);
        $big_image = BigImage::where('id', 1)->first();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('bigInfo.show', ['header_body' => $header_body, 'big_image' => $big_image]));

        $response->assertStatus(302);
    }
}
