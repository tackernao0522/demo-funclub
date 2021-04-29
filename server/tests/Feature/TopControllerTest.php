<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use TopTitlesTableSeeder;
use PrimaryCategoriesTableSeeder;
use SubTitlesTableSeeder;
use App\TopTitle;
use App\User;
use Tests\TestCase;

class TopControllerTest extends TestCase
{
    use RefreshDatabase;

    // TopページへアクセスするとStatus200が返されるか
    public function testIndex()
    {
        // $this->seed(TopTitlesTableSeeder::class);
        $top = factory(TopTitle::class)->create();

        $response = $this->get(route('top', ['top' => $top]));

        $response->assertStatus(200)
            ->assertViewIs('top');
    }

    // 未ログイン時にTopページのナビゲーションバーのNEWSをクリックしてもログイン画面にリダイレクトする
    public function testGuestNewsNav()
    {
        $response = $this->get('news');

        $response->assertRedirect(route('login'));
    }

    // ログイン状態でTopページのナビゲーションバーのNEWSをクリックすればNEWSインデックス画面に遷移する
    public function testAuthUserGetNews()
    {
        $this->seed(PrimaryCategoriesTableSeeder::class);
        $this->seed(SubTitlesTableSeeder::class);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
            ->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }


    // 未ログイン時にTopページの"INFORMATION"をクリックするとログイン画面にリダイレクトする
    public function testGuestGetInformation()
    {
        $response = $this->get(route('informations.index'));

        $response->assertRedirect(route('login'));
    }

    // ログイン状態でTopページの"INFORMATION"をクリックするとInformationページに遷移
    public function testAuthUserGetInformation()
    {
        $this->seed();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('informations.index'));

        $response->assertStatus(200)
            ->assertViewIs('informations.index');
    }

    // 未ログインでもログイン時でもContactPageにアクセス可能
    public function testGuestOrAuthUserContact()
    {
        $response = $this->get(route('contact.form'));

        $response->assertStatus(200)
            ->assertViewIs('contact.contact_form');
    }
}
