<?php

use App\Models\Champion;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
test('it updates a champion with valid data', function () {
    $champion = Champion::create([
        'name' => 'Lux', 'role' => 'mid', 'isAvailable' => true, 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2'
    ]);

    $data = [
        'name' => 'Lux Updated',
        'role' => 'mid',
        'isAvailable' => false,
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => false,
        'heals' => true,
        'tanky' => true,
        'squishy' => false,
        'has_cc' => false,
        'dash' => true,
        'poke' => false,
        'can_one_shot' => true,
        'late_game' => false,
        'is_good_against_attack_damage' => '1',
        'is_good_against_magic_damage' => '1',
        'is_good_against_shield' => '1',
        'is_good_against_heals' => '1',
        'is_good_against_tanky' => '1',
        'is_good_against_squish' => '1',
        'is_good_against_has_cc' => '1',
        'is_good_against_dash' => '1',
        'is_good_against_poke' => '1',
        'is_good_against_can_one_shot' => '1',
        'is_good_against_late_game' => '1',
    ];

    $response = $this->putJson("/api/champions/{$champion->id}", $data);

    $response->assertOk()
        ->assertJsonFragment(['name' => 'Lux Updated']);

    $this->assertDatabaseHas('champions', ['id' => $champion->id, 'name' => 'Lux Updated']);
});

test('it fails to update when boolean fields are invalid', function () {
    $champion = Champion::create([
        'name' => 'Teemo',
        'role' => 'top',
        'isAvailable' => true,
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => true,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
        'is_good_against_attack_damage' => '2',
        'is_good_against_magic_damage' => '2',
        'is_good_against_shield' => '2',
        'is_good_against_heals' => '2',
        'is_good_against_tanky' => '2',
        'is_good_against_squish' => '2',
        'is_good_against_has_cc' => '2',
        'is_good_against_dash' => '2',
        'is_good_against_poke' => '2',
        'is_good_against_can_one_shot' => '2',
        'is_good_against_late_game' => '2',
    ]);

    $data = [
        'shield' => 'not-a-boolean',
    ];

    $response = $this->putJson("/api/champions/{$champion->id}", $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['shield']);
});

test('it fails to update when role is invalid', function () {
    $champion = Champion::create([
        'name' => 'Teemo',
        'role' => 'top',
        'isAvailable' => true,
        'attack_damage' => true,
        'magic_damage' => false,
        'shield' => true,
        'heals' => false,
        'tanky' => false,
        'squishy' => true,
        'has_cc' => true,
        'dash' => false,
        'poke' => true,
        'can_one_shot' => false,
        'late_game' => true,
        'is_good_against_attack_damage' => '2',
        'is_good_against_magic_damage' => '2',
        'is_good_against_shield' => '2',
        'is_good_against_heals' => '2',
        'is_good_against_tanky' => '2',
        'is_good_against_squish' => '2',
        'is_good_against_has_cc' => '2',
        'is_good_against_dash' => '2',
        'is_good_against_poke' => '2',
        'is_good_against_can_one_shot' => '2',
        'is_good_against_late_game' => '2',
    ]);

    $data = [
        'role' => 'invalid-role',
    ];

    $response = $this->putJson("/api/champions/{$champion->id}", $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['role']);
});
