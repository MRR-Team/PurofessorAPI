<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it updates a user with valid data', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
    ]);

    $data = [
        'name' => 'John Updated',
        'email' => 'john.updated@example.com',
    ];

    $response = $this->putJson("/api/users/{$user->id}", $data);

    $response->assertStatus(201)
        ->assertJsonFragment(['name' => 'John Updated']);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'John Updated',
        'email' => 'john.updated@example.com',
    ]);
});

test('it fails to update when email is invalid', function () {
    $user = User::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'password' => bcrypt('password'),
    ]);

    $data = [
        'email' => 'not-an-email',
    ];

    $response = $this->putJson("/api/users/{$user->id}", $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});
