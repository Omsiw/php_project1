<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Game;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Tag;
use App\Models\OS;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{

    public function test_if_can_show_all_games(): void{
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/gameSelect');

        $response->assertStatus(200);
    }

    public function test_if_can_show_a_game_by_id(): void{
        $game = Game::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/gameSelect/' . $game->id);

        $response->assertStatus(200);
    }
    // Route::get('/gameSelectByTagId/{id}', [GameController::class, 'selectByTagId']);
    // Route::get('/gameSelectByUserId/{id}', [GameController::class, 'selectByUserId']);
    // Route::get('/gameSelectBygameId/{id}', [GameController::class, 'selectBygameId']);
    // Route::get('/gameSelectByPublisherId/{id}', [GameController::class, 'selectByPublisherId']);

    public function test_if_can_show_a_game_by_tag_id(): void{
        $game = Game::factory()->raw();

        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $os[] = OS::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $tag[] = Tag::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $author[] = Author::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $publisher[] = Publisher::factory()->create()->id;
        }
        $data = $game;
        $data['os_ids'] = $os;
        $data['tag_ids'] = $tag;
        $data['author_ids'] = $author;
        $data['publisher_ids'] = $publisher; 

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/gameCreate', $data);

        $response->assertStatus(201);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/gameSelectByTagId/' . $tag[0]);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_game(): void{
        $game = Game::factory()->raw();

        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $os[] = OS::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $tag[] = Tag::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $author[] = Author::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $publisher[] = Publisher::factory()->create()->id;
        }

        $data = $game;
        $data['os_ids'] = $os;
        $data['tag_ids'] = $tag;
        $data['author_ids'] = $author;
        $data['publisher_ids'] = $publisher; 

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/gameCreate', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('games', $game);
    }

    public function test_if_can_update_a_game(): void{
        $game = Game::factory()->create();

        $updateData = Game::factory()->raw();

        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $os[] = OS::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $tag[] = Tag::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $author[] = Author::factory()->create()->id;
        }
        for($i = 0; $i < fake()->numberBetween(1,3); $i++){
            $publisher[] = Publisher::factory()->create()->id;
        }

        $data = $updateData;
        $data['os_ids'] = $os;
        $data['tag_ids'] = $tag;
        $data['author_ids'] = $author;
        $data['publisher_ids'] = $publisher; 

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/gameUpdate/' . $game->id, $data);

        $response->assertStatus(202);
        $this->assertDatabaseHas('games', array_merge(['id' => $game->id], $updateData));
    }

    public function test_if_can_delete_a_game(): void{
        $game = Game::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/gameDelete/' . $game->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('games', ['id' => $game->id]);
    }
}
