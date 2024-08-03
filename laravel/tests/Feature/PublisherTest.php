<?php

namespace Tests\Feature;

use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    public function if_can_create_a_publisher(): void{
        $publisher = Publisher::factory()->raw();

        $response = $this->post('/api/publCreate', $publisher);

        $response->assertStatus(201);
        $this->assertDatabaseHas('publishers', $publisher);
    }

    public function if_can_update_a_publisher(): void{
        $publisher = Publisher::factory()->create();

        $updateData = [
            'name' => 'update name'
        ];

        $response = $this->post('/api/publUpdate/' . $publisher->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('publishers', array_merge(['id' => $publisher->id], $updateData));
    }

    public function if_can_delete_a_publisher(): void{
        $publisher = Publisher::factory()->create();

        $response = $this->get('/api/publDelete/' . $publisher->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('publishers', ['id' => $publisher->id]);
    }
}
