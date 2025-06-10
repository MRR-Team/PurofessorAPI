<?php


namespace Database\Factories;

use App\Models\Champion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChampionFactory extends Factory
{
    protected $model = Champion::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->firstName,
            'photo' => $this->faker->imageUrl(),
            'position' => $this->faker->randomElement(['mid', 'top', 'jungle', 'bot', 'support']),
            'role' => $this->faker->randomElement(['mage', 'adc', 'tank', 'supp', 'fighter', 'assasin']),
            'attack_damage' => false,
            'magic_damage' => false,
            'shield' => false,
            'heals' => false,
            'tanky' => false,
            'squishy' => false,
            'has_cc' => false,
            'dash' => false,
            'poke' => false,
            'can_one_shot' => false,
            'late_game' => false,
            'isAvailable' => true,
            'is_good_against_attack_damage' => 0,
            'is_good_against_magic_damage' => 0,
            'is_good_against_shield' => 0,
            'is_good_against_heals' => 0,
            'is_good_against_tanky' => 0,
            'is_good_against_squish' => 0,
            'is_good_against_has_cc' => 0,
            'is_good_against_dash' => 0,
            'is_good_against_poke' => 0,
            'is_good_against_can_one_shot' => 0,
            'is_good_against_late_game' => 0,
        ];
    }
}
