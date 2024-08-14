<?php

namespace Tests\Feature;

use App\Models\Discount;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscountTest extends TestCase
{//
    public function test_if_can_show_discount_by_game_id(): void{
        $discount = Discount::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/discountSelectByGameId/' . $discount->game_id);

        $response->assertStatus(200);

    }

    public function test_if_can_create_a_discount(): void{
        $discount = Discount::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/discountCreate', $discount);

        $response->assertStatus(201);
        $this->assertDatabaseHas('discounts', $discount);
    }

    public function test_if_can_update_a_discount(): void{
        $discount = Discount::factory()->create();
        
        $updateData = Discount::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/discountUpdate/' . $discount->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('discounts', array_merge(['id' => $discount->id], $updateData));
    }

    public function test_if_can_delete_a_discount(): void{
        $discount = Discount::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/discountDelete/' . $discount->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('discounts', ['id' => $discount->id]);
    }
}
