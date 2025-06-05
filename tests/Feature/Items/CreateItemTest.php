<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

test('it creates a item with valid data', function () {
    $data = [
        'name' => 'Lux',
        'role' => 'mage',
        'attack_damage' => false,
        'magic_damage' => true,
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
    ];

    $response = $this->postJson('/api/items', $data);

    $response->assertCreated()
        ->assertJsonFragment(['name' => 'Lux']);

    $this->assertDatabaseHas('items', ['name' => 'Lux']);
});

test('it fails when required fields are missing', function () {
    $response = $this->postJson('/api/items', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'role']);
});

test('it fails when boolean fields are invalid', function () {
    $data = [
        'name' => 'Teemo',
        'position' => 'top',
        'shield' => 'not-a-boolean',
    ];

    $response = $this->postJson('/api/items', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['shield']);
});

test('it fails when role is invalid', function () {
    $data = [
        'name' => 'Teemo',
        'role' => 'topo',
    ];

    $response = $this->postJson('/api/items', $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['role']);
});
