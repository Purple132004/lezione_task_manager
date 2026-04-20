<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\postJson;

pest()->use(RefreshDatabase::class);

it('allows an authenticated user to create a task', function () {
    // AAA pattern
    // A -> arrange
    $user = User::factory()->create();

    // A -> act
    $response = actingAs($user)->postJson('/api/tasks', [
        'title' => 'Test task',
        'description' => 'Lorem ipsum dolor sit'
    ]);

    // A -> assert
    $response
        ->assertCreated()
        ->assertJsonFragment([
            'title' => 'Test task'
        ]);

    $this->assertDatabaseHas('tasks', [
        'title' => 'Test task',
        'user_id' => $user->id
    ]);
});

it('requires a title to create a task', function () {
    $user = User::factory()->create();

    $response = actingAs($user)->postJson('/api/tasks', [
        'description' => 'Missing title'
    ]);

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['title']);
});

it('doesnt allow guest to create tasks', function (){
    $response = postJson('/api/tasks', [
        'title' => 'Task by guest'
    ]);

    $response->assertUnauthorized();
});