<?php

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);
beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
});
test('it deletes a item by id', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    Sanctum::actingAs($admin, ['*']);
    $item =Item::create([
        'name' => 'Lux', 'role' => 'mage', 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2', 'photo'=>'1'
    ]);

    $response = $this->deleteJson("/api/items/{$item->id}");

    $response->assertNoContent();

    $this->assertDatabaseMissing('items', [
        'id' => $item->id,
    ]);
});

test('it fails when non admin tries to delete item', function () {
    $fakeAdmin = User::factory()->create();
    Sanctum::actingAs($fakeAdmin, ['*']);
    $item = Item::create([
        'name' => 'Lux', 'role' => 'mage', 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2', 'photo'=>'1'
    ]);

    $response = $this->deleteJson("/api/items/{$item->id}");
    $response->assertStatus(403);
});
