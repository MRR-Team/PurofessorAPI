<?php

use App\Models\Champion;
use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);
beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
});
test('it updates a champion with valid data', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    Sanctum::actingAs($admin, ['*']);
    $item = Item::create([
        'name' => 'Lux', 'role' => 'mage', 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2', 'photo'=>'1'
    ]);

    $data = [
        'name' => 'Lux Updated',
        'role' => 'mage',
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
        'photo'=>'1'
    ];

    $response = $this->putJson("/api/items/{$item->id}", $data);

    $response->assertOk()
        ->assertJsonFragment(['name' => 'Lux Updated']);

    $this->assertDatabaseHas('items', ['id' => $item->id, 'name' => 'Lux Updated']);
});

test('it fails to update when boolean fields are invalid', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    Sanctum::actingAs($admin, ['*']);
    $item = Item::create([
        'name' => 'Teemo',
        'role' => 'mage',
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
        'photo'=>'1'
    ]);

    $data = [
        'shield' => 'not-a-boolean',
    ];

    $response = $this->putJson("/api/items/{$item->id}", $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['shield']);
});

test('it fails to update when role is invalid', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    Sanctum::actingAs($admin, ['*']);
    $item = Item::create([
        'name' => 'Teemo',
        'role' => 'mage',
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
        'photo'=>'1'
    ]);

    $data = [
        'role' => 'invalid-role',
    ];

    $response = $this->putJson("/api/items/{$item->id}", $data);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['role']);
});

test('it fails when non admin tries to edit item', function () {
    $fakeAdmin = User::factory()->create();
    Sanctum::actingAs($fakeAdmin, ['*']);
    $item = Item::create([
        'name' => 'Teemo',
        'role' => 'mage',
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
        'photo'=>'1'
    ]);

    $data = [
        'role' => 'adc',
    ];

    $response = $this->putJson("/api/items/{$item->id}", $data);
    $response->assertStatus(403);
});
