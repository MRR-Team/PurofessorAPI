<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);
test('it shows a champion by id', function () {
    $champion = \App\Models\Champion::create([
        'name' => 'Lux', 'role' => 'mid', 'isAvailable' => true, 'attack_damage' => false, 'magic_damage' => true, 'shield' => true, 'heals' => false, 'tanky' => false, 'squishy' => true, 'has_cc' => true, 'dash' => false, 'poke' => true, 'can_one_shot' => false, 'late_game' => true, 'is_good_against_attack_damage' => '2', 'is_good_against_magic_damage' => '2', 'is_good_against_shield' => '2', 'is_good_against_heals' => '2', 'is_good_against_tanky' => '2', 'is_good_against_squish' => '2', 'is_good_against_has_cc' => '2', 'is_good_against_dash' => '2', 'is_good_against_poke' => '2', 'is_good_against_can_one_shot' => '2', 'is_good_against_late_game' => '2'
    ]);

    $response = $this->getJson("/api/champions/{$champion->id}");

    $response->assertOk()
        ->assertJsonFragment([
            'name' => 'Lux',
            'role' => 'mid',
        ]);
});

