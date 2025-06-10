<?php
use App\Models\Champion;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it returns best counters for given enemy champion and position', function () {
    $enemyChampion = Champion::factory()->create([
        'name' => 'Ahri',
        'position' => 'mid',
        'attack_damage' => true,
    ]);

    $counter = Champion::factory()->create([
        'name' => 'Annie',
        'position' => 'mid',
        'isAvailable' => true,
        'is_good_against_attack_damage' => 10,
    ]);

    $weakerChampion = Champion::factory()->create([
        'name' => 'Zoe',
        'position' => 'mid',
        'isAvailable' => true,
        'is_good_against_attack_damage' => 1,
    ]);

    $response = $this->getJson("/api/counter/mid/{$enemyChampion->id}");

    $response->assertOk();
    $response->assertJsonFragment(['name' => 'Annie']);
    $response->assertJsonMissing(['name' => 'Zoe']);
});
