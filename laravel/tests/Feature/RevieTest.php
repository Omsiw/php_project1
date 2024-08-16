<?php

namespace Tests\Feature;

use App\Models\Revie;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RevieTest extends TestCase
{
    // Route::get('/revieSelectByUserId/{id}', [RevieController::class, 'selectByUserId']);
    // Route::get('/revieSelectByGameId/{id}', [RevieController::class, 'selectByUserId']);

    public function test_if_can_show_a_revie_by_user_id(): void{
        $revie = Revie::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/revieSelectByUserId/' . $revie->user_id);

        $response->assertStatus(200);
    }

    public function test_if_can_show_a_revie_by_game_id(): void{
        $revie = Revie::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/revieSelectByGameId/' . $revie->game_id);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_revie(): void{
        $revie = Revie::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/revieCreate', $revie);

        $response->assertStatus(201);
        $this->assertDatabaseHas('revies', $revie);
    }

    public function test_if_can_update_a_revie(): void{
        $revie = Revie::factory()->create();

        $updateData = Revie::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/revieUpdate/' . $revie->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('revies', array_merge(['id' => $revie->id], $updateData));
    }

    public function test_if_can_delete_a_revie(): void{
        $revie = Revie::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/revieDelete/' . $revie->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('revies', ['id' => $revie->id]);
    }
}
