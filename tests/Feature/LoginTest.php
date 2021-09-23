<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * ログイン画面表示テスト
     * 
     * @return void
     */
    public function testLoginView()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * ログイン成功テスト
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'testtest', //正しいパスワード
        ]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * ログイン失敗テスト
     *
     * @return void
     */
    public function testLoginFailure()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'testtes', //間違ったパスワード
        ]);
        
        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
