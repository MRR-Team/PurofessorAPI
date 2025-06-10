<?php

use App\Models\Champion;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('it fails to return best items for given champion and enemy champion for not logged in', function () {
    $enemy = Champion::factory()->create([
        'name' => 'EnemyChamp',
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => false,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
    ]);

    $champion = Champion::factory()->create([
        'name' => 'MyChamp',
        'role' => 'fighter',
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => false,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
    ]);

    Item::factory()->create([
        'name' => 'Good Item',
        'role' => 'fighter',
        'attack_damage' => true,
        'shield' => true,
        'squishy' => true,
        'poke' => true,
        'late_game' => true,
        'is_good_against_attack_damage' => 2,
        'is_good_against_shield' => 2,
        'is_good_against_squish' => 1,
        'is_good_against_poke' => 1,
        'is_good_against_late_game' => 2,
    ]);

    Item::factory()->create([
        'name' => 'Bad Item',
        'role' => 'mage',
        'attack_damage' => false,
        'magic_damage' => true,
    ]);

    $response = $this->getJson("/api/build/{$enemy->id}/against/{$champion->id}");

    $response->assertStatus(401);
});

test('it returns best items for given champion and enemy champion', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user, ['*']);
    $enemy = Champion::factory()->create([
        'name' => 'EnemyChamp',
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => false,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
    ]);

    $champion = Champion::factory()->create([
        'name' => 'MyChamp',
        'role' => 'fighter',
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => false,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
    ]);

    Item::factory()->create([
        'name' => 'Good Item',
        'role' => 'fighter',
        'attack_damage' => true,
        'shield' => true,
        'squishy' => true,
        'poke' => true,
        'late_game' => true,
        'is_good_against_attack_damage' => 2,
        'is_good_against_shield' => 2,
        'is_good_against_squish' => 1,
        'is_good_against_poke' => 1,
        'is_good_against_late_game' => 2,
    ]);

    Item::factory()->create([
        'name' => 'Bad Item',
        'role' => 'mage',
        'attack_damage' => false,
        'magic_damage' => true,
    ]);

    $response = $this->getJson("/api/build/{$enemy->id}/against/{$champion->id}");

    $response->assertOk()
        ->assertJsonCount(1)
        ->assertJsonFragment(['name' => 'Good Item'])
        ->assertJsonMissing(['name' => 'Bad Item']);
});
