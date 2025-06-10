<?php

use App\Models\Champion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);
beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
});
test('it deletes a champion by id', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    Sanctum::actingAs($admin, ['*']);
    $champion = Champion::create([
        'name' => 'Lux', 'role' => 'mid', 'isAvailable' => true, 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2', 'position'=>'mid', 'photo'=>'1'
    ]);

    $response = $this->deleteJson("/api/champions/{$champion->id}");

    $response->assertNoContent();

    $this->assertDatabaseMissing('champions', [
        'id' => $champion->id,
    ]);
});

test('it fails when non admin tries to delete item', function () {
    $fakeAdmin = User::factory()->create();
    Sanctum::actingAs($fakeAdmin, ['*']);
    $champion = Champion::create([
        'name' => 'Lux', 'role' => 'mage','position'=>'mid', 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2', 'photo'=>'1'
    ]);

    $response = $this->deleteJson("/api/champions/{$champion->id}");
    $response->assertStatus(403);
});
