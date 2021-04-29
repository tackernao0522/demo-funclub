<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class InformationControllerTest extends TestCase
{
    use RefreshDatabase;

    // 未ログイン時にInformation新規投稿ページにアクセスしてもログイン画面にリダイレクトする
    public function testGuestInformationCreateForm()
    {
        $response = $this->get(route('information.create'));

        $response->assertRedirect(route('login'));
    }

    // AdminがInformation新規投稿ページにアクセスするとアクセスできる
    public function testAdminInformationCreateForm()
    {
        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('information.create'));

        $response->assertStatus(200)
            ->assertViewIs('admin.information.form');
    }

    // MemberがInformation新規投稿ページアクセスするとTopページにリダイレクトする
    public function testMemberInformationCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('information.create'));

        $response->assertRedirect(route('top'));
    }

    // PremiumがInformation新規投稿ページアクセスするとTopページにリダイレクトする
    public function testPremiumInformationCreateForm()
    {
        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('information.create'));

        $response->assertRedirect(route('top'));
    }
}
