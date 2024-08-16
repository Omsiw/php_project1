<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Mod;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModTest extends TestCase
{
    
    // Route::get('/modSelectById/{id}', [ModController::class, 'item']);
    // Route::get('/modSelectByUserId/{id}', [ModController::class, 'selectByUserId']);
    // Route::get('/modSelectByGameId/{id}', [ModController::class, 'selectByGameId']);
    // Route::get('/modSelectByAuthorId/{id}', [ModController::class, 'selectByAuthorId']);
    public function test_if_can_show_a_mod_by_id(): void{
        $mod = Mod::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/modSelectById/' . $mod->id);

        $response->assertStatus(200);
    }
    public function test_if_can_show_a_mod_by_game_id(): void{
        $mod = Mod::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/modSelectByGameId/' . $mod->game_id);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_mod(): void{
        $mod = Mod::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/modCreate', $mod);

        $response->assertStatus(201);
        $this->assertDatabaseHas('mods', $mod);
    }

    public function test_if_can_update_a_mod(): void{
        $mod = Mod::factory()->create();

        $updateData = Mod::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/modUpdate/' . $mod->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('mods', array_merge(['id' => $mod->id], $updateData));
    }

    public function test_if_can_delete_a_mod(): void{
        $mod = Mod::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/modDelete/' . $mod->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('mods', ['id' => $mod->id]);
    }
}
