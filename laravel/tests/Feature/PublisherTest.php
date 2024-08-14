<?php

namespace Tests\Feature;

use App\Models\Publisher;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    public function test_if_can_create_a_publisher(): void{
        $publisher = Publisher::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/publCreate', $publisher);

        $response->assertStatus(201);
        $this->assertDatabaseHas('publishers', $publisher);
    }

    public function test_if_can_update_a_publisher(): void{
        $publisher = Publisher::factory()->create();

        $updateData = Publisher::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/publUpdate/' . $publisher->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('publishers', array_merge(['id' => $publisher->id], $updateData));
    }

    public function test_if_can_delete_a_publisher(): void{
        $publisher = Publisher::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/publDelete/' . $publisher->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('publishers', ['id' => $publisher->id]);
    }
}
