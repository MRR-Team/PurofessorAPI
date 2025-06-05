<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
test('it returns all users', function () {
    \App\Models\User::create(['name' => 'Jan', 'email' => 'jan@example.com', 'password' => 'secret123',]);
    \App\Models\User::create(['name' => 'Janina', 'email' => 'janina@example.com', 'password' => 'secret123',]);

    $response = $this->getJson('/api/users');

    $response->assertOk()
        ->assertJsonCount(2)
        ->assertJsonFragment(['name' => 'Jan'])
        ->assertJsonFragment(['name' => 'Janina']);
});
