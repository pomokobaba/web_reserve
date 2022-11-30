<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_successed()
    {
        // ユーザーの作成
        $user = User::factory()->create();
        // つぶやきの作成
        $tweet = Tweet::factory()->create([
            'user_id' => $user->id
        ]);

        // 指定したユーザーでログインした状態にする
        $this->actingAs($user);

        // 作成したつぶやきのIDを指定
        $response = $this->delete('/tweet/delete/'. $tweet->id);

        $response->assertRedirect('/tweet');
    }
}
