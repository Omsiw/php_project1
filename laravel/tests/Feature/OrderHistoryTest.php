<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\OrderHistory;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderHistoryTest extends TestCase
{
    public function test_if_can_show_a_order_history_by_user_id(): void{
        $orderHistory = OrderHistory::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/orderSelectByUserId/' . $orderHistory->id);

        $response->assertStatus(200);
    }

    public function test_if_can_create_a_order_history(): void{
        $orderHistory = OrderHistory::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/OrdHisCreate', $orderHistory);

        $response->assertStatus(201);
        $this->assertDatabaseHas('order_histories', $orderHistory);
    }

    public function test_if_can_update_a_order_history(): void{
        $orderHistory = OrderHistory::factory()->create();

        $updateData = OrderHistory::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/OrdHisUpdate/' . $orderHistory->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('order_histories', array_merge(['id' => $orderHistory->id], $updateData));
    }

    public function test_if_can_delete_a_order_history(): void{
        $orderHistory = OrderHistory::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/OrdHisDelete/' . $orderHistory->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('order_histories', ['id' => $orderHistory->id]);
    }
}
