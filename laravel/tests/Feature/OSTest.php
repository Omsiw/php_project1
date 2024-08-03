<?php

namespace Tests\Feature;

use App\Models\OS;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OSTest extends TestCase
{
    public function if_can_create_a_os(): void{
        $os = OS::factory()->raw();

        $response = $this->post('/api/osCreate', $os);

        $response->assertStatus(201);
        $this->assertDatabaseHas('o_s', $os);
    }

    public function if_can_update_a_os(): void{
        $os = OS::factory()->create();

        $updateData = [
            'name' => 'update name'
        ];

        $response = $this->post('/api/osUpdate/' . $os->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('o_s', array_merge(['id' => $os->id], $updateData));
    }

    public function if_can_delete_a_os(): void{
        $os = OS::factory()->create();

        $response = $this->get('/api/osDelete/' . $os->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('o_s', ['id' => $os->id]);
    }
}
