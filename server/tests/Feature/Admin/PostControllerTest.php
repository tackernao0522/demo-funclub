<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    // 未ログイン時にNews新規投稿フォームにアクセスしてもログイン画面にリダイレクトする
    public function testGuestArticleCreateForm()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    // 'Admin'はNews新規投稿フォームにアクセスできる
    public function testAdminArticleCreateForm()
    {
        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.posts.form');
    }

    // MemberがNews新規投稿フォームにアクセスするとTopページにリダイレクトする
    public function testMemberArticleCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertRedirect(route('top'));
    }

    // premiumが新規投稿フォームにアクセスするとTopページにリダイレクトする
    public function testPremiumArticleCreateForm()
    {
        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertRedirect(route('top'));
    }
}
