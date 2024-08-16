<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_if_can_show_a_order_by_user_id(): void{
        $order = Order::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->get('/api/orderSelectByUserId/' . $order->id);

        $response->assertStatus(200);
    }
    
    public function test_if_can_create_a_order(): void{
        $order = Order::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->post('/api/orderCreate', $order);

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', $order);
    }

    public function test_if_can_update_a_order(): void{
        $order = Order::factory()->create();

        $updateData = Order::factory()->raw();

        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/orderUpdate/' . $order->id, $updateData);

        $response->assertStatus(202);
        $this->assertDatabaseHas('orders', array_merge(['id' => $order->id], $updateData));
    }

    public function test_if_can_delete_a_order(): void{
        $order = Order::factory()->create();
        
        Sanctum::actingAs(
            User::factory()->create(),
            ['view-tasks']
        );

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/orderDelete/' . $order->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
