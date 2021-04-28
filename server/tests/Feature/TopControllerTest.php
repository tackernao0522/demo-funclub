<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use TopTitlesTableSeeder;
use App\User;
use Tests\TestCase;

class TopControllerTest extends TestCase
{
    use RefreshDatabase;

    // TopページへアクセスするとStatus200が返されるか
    public function testIndex()
    {
        $this->seed(TopTitlesTableSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('top');
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
}
