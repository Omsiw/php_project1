<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function if_can_create_a_tag(): void{
        $tag = Tag::factory()->raw();

        $response = $this->post('/api/tagCreate', $tag);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', $tag);
    }

    public function if_can_update_a_tag(): void{
        $tag = Tag::factory()->create();

        $updateData = [
            'name' => 'update name'
        ];

        $response = $this->post('/api/tagUpdate/' . $tag->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('tags', array_merge(['id' => $tag->id], $updateData));
    }

    public function if_can_delete_a_tag(): void{
        $tag = Tag::factory()->create();

        $response = $this->get('/api/tagDelete/' . $tag->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
