<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use TopTitlesTableSeeder;
use Tests\TestCase;
use App\User;

class TopControllerTest extends TestCase
{
    use RefreshDatabase;

    // 未ログイン時にTopページタイトルフォームにアクセスしてもログイン画面にリダイレクトする
    public function testGuestTopTitleForm()
    {
        $response = $this->get(route('top.edit_form'));

        $response->assertRedirect(route('login'));
    }

    // AdminはTopタイトル編集フォームにアクセスできる
    public function testAdminTopTitleForm()
    {
        $this->seed(TopTitlesTableSeeder::class);

        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('top.edit_form'));

        $response->assertStatus(200)
            ->assertViewIs('admin.top.title_form');
    }

    // MemberがTopタイトル編集フォームにアクセスするとTopページにリダイレクトする
    public function testMemberTopTitleForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('top.edit_form'));

        $response->assertRedirect(route('top'));
    }

    // PremiumがTopタイトル編集フォームにアクセスするとTopページにリダイレクトする
    public function testPremiumTopTitleForm()
    {
        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('top.edit_form'));

        $response->assertRedirect(route('top'));
    }
}
