<?php

namespace Tests\Feature;

use App\Models\DLS;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DLSTest extends TestCase
{
    /*    Route::get('/dlsSelectById/{id}', [DLSController::class, 'item']);
    Route::get('/dlsSelectByUserId/{id}', [DLSController::class, 'selectByUserId']);
    Route::get('/dlsSelectByGameId/{id}', [DLSController::class, 'selectByGameId']);
    Route::get('/dlsSelectByAuthorId/{id}', [DLSController::class, 'selectByAuthorId']);
    Route::get('/dlsSelectByPublisherId/{id}', [DLSController::class, 'selectByPublisherId']); */
    public function test_if_can_show_dls_by_id(): void{
        $dls = DLS::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/dlsSelectById/' . $dls->id);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_dls(): void{
        $dls = DLS::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/dlsCreate', $dls);

        $response->assertStatus(201);
        $this->assertDatabaseHas('d_l_s', $dls);
    }

    public function test_if_can_update_a_dls(): void{
        $dls = DLS::factory()->create();

        $updateData = DLS::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/dlsUpdate/' . $dls->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('d_l_s', array_merge(['id' => $dls->id], $updateData));
    }

    public function test_if_can_delete_a_dls(): void{
        $dls = DLS::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/dlsDelete/' . $dls->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('d_l_s', ['id' => $dls->id]);
    }
}
