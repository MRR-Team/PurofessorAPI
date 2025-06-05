<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
test('it shows a champion by id', function () {
    $user = \App\Models\User::create([
        'name' => 'Lux', 'email' => 'lux@lux.com', 'password' => 'password',
    ]);

    $response = $this->getJson("/api/users/{$user->id}");

    $response->assertOk()
        ->assertJsonFragment([
            'name' => 'Lux',
            'email' => 'lux@lux.com',
        ]);
});

