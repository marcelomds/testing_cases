<?php

namespace Tests\Feature;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_task()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'Minha tarefa'
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Minha tarefa']);
    }

    public function test_can_list_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}
