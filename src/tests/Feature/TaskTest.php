<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:refresh');
        parent::tearDown();
    }

    /** @test */
    public function addTask()
    {
        $name = 'A New Task';

        $response = $this->json('POST', '/task', ['name' => $name]);

        $response
            ->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'name' => $name
        ]);
    }

    /** @test */
    public function deleteTask()
    {
        $id = 1;

        $response = $this->json('DELETE', '/task/' . $id);

        $response
            ->assertStatus(302);

        $this->assertDatabaseMissing('tasks', [
            'id' => $id
        ]);
    }
}
