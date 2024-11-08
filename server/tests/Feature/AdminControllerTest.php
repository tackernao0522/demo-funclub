<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    // 未ログイン時に'/admin'にアクセスしてもログイン画面にリダイレクトする
    public function testGuestAdminIndex()
    {
        $response = $this->get(route('admin'));

        $response->assertRedirect(route('login'));
    }

    // 'admin'が'/admin'にアクセスするとAdminインデックスページに遷移する
    public function testAdminIndex()
    {
        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin'));

        $response->assertStatus(200)
            ->assertViewIs('admin.index');
    }

    // memberがAdminインデックスにアクセスするとTopページにリダイレクトする
    public function testMemberAdminIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('admin'));

        $response->assertRedirect(route('top'));
    }

    // premiumがAdminインデックスにアクセスするとTopページにリダイレクトする
    public function testPremiumAdminIndex()
    {
        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('admin'));

        $response->assertRedirect(route('top'));
    }

    // 未ログイン時にAdmin用Contactリストにアクセスするとログイン画面にリダイレクトする
    public function testGuestContactList()
    {
        $response = $this->get(route('contact.list'));

        $response->assertRedirect(route('login'));
    }

    // 'Admin'はContactリストにアクセスできる
    public function testAdminContactList()
    {
        $user = factory(User::class)->make([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get(route('contact.list'));

        $response->assertViewIs('admin.contacts.list');
    }

    // MemberがContactリストにアクセスするとTopページにリダイレクトする
    public function testMemberContactList()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('contact.list'));

        $response->assertRedirect(route('top'));
    }

    // PremiumがContactリストにアクセスするとTopページにリダイレクトする
    public function testPremiumContactList()
    {
        $user = factory(User::class)->make([
            'role' => 'premium',
        ]);

        $response = $this->actingAs($user)
            ->get(route('contact.list'));

        $response->assertRedirect(route('top'));
    }
}
