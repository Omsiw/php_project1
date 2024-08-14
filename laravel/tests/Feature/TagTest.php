<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_if_can_create_a_tag(): void{
        $tag = Tag::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/tagCreate', $tag);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', $tag);
    }

    public function test_if_can_update_a_tag(): void{
        $tag = Tag::factory()->create();

        $updateData = Tag::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/tagUpdate/' . $tag->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('tags', array_merge(['id' => $tag->id], $updateData));
    }

    public function test_if_can_delete_a_tag(): void{
        $tag = Tag::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/tagDelete/' . $tag->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
