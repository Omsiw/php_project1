<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    public function if_can_create_a_author(): void{
        $author = Author::factory()->raw();

        $response = $this->post('/api/authorCreate', $author);

        $response->assertStatus(201);
        $this->assertDatabaseHas('authors', $author);
    }

    public function if_can_update_a_author(): void{
        $author = Author::factory()->create();

        $updateData = [
            'name' => 'update name'
        ];

        $response = $this->post('/api/authorUpdate/' . $author->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('authors', array_merge(['id' => $author->id], $updateData));
    }

    public function if_can_delete_a_author(): void{
        $author = Author::factory()->create();

        $response = $this->get('/api/authorDelete/' . $author->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}