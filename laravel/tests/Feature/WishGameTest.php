<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WishGame;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WishGameTest extends TestCase
{
    public function test_if_can_show_a_whis_game_by_user_id(): void{
        $wishGame = WishGame::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/whGameSelectByUserId/' . $wishGame->user_id);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_whis_game(): void{
        $wishGame = WishGame::factory()->raw();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/whGameCreate', $wishGame);

        $response->assertStatus(201);
        $this->assertDatabaseHas('wish_games', $wishGame);
    }

    public function test_if_can_delete_a_whis_game(): void{
        $wishGame = WishGame::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/whGameDelete/' . $wishGame->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('wish_games', ['id' => $wishGame->id]);
    }
}
