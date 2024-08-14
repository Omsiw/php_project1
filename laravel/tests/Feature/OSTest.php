<?php

namespace Tests\Feature;

use App\Models\OS;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OSTest extends TestCase
{
    public function test_if_can_create_a_os(): void{
        $os = OS::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/osCreate', $os);

        $response->assertStatus(201);
        $this->assertDatabaseHas('o_s', $os);
    }

    public function test_if_can_update_a_os(): void{
        $os = OS::factory()->create();

        $updateData = OS::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/osUpdate/' . $os->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('o_s', array_merge(['id' => $os->id], $updateData));
    }

    public function test_if_can_delete_a_os(): void{
        $os = OS::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/osDelete/' . $os->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('o_s', ['id' => $os->id]);
    }
}
