<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
test('it deletes a user by id', function () {
    $user = \App\Models\User::create([
        'name' => 'Lux', 'email' => 'lux@lux.com', 'password' => 'password',
        ]);

    $response = $this->deleteJson("/api/users/{$user->id}");

    $response->assertNoContent();

    $this->assertDatabaseMissing('champions', [
        'id' => $user->id,
    ]);
});
