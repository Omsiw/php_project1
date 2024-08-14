<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    public function test_if_can_create_a_author(): void{
        $author = Author::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/authorCreate', $author);

        $response->assertStatus(201);
        $this->assertDatabaseHas('authors', $author);
    }

    public function test_if_can_update_a_author(): void{
        $author = Author::factory()->create();

        $updateData = Author::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/authorUpdate/' . $author->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('authors', array_merge(['id' => $author->id], $updateData));
    }

    public function test_if_can_delete_a_author(): void{
        $author = Author::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/authorDelete/' . $author->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}