<?php


namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'photo' => $this->faker->imageUrl(),
            'name' => $this->faker->unique()->word(),
            'role' => $this->faker->randomElement(['fighter', 'mage', 'assassin', 'tank', 'support', 'adc']),
            'attack_damage' => $this->faker->boolean(),
            'magic_damage' => $this->faker->boolean(),
            'shield' => $this->faker->boolean(),
            'heals' => $this->faker->boolean(),
            'tanky' => $this->faker->boolean(),
            'squishy' => $this->faker->boolean(),
            'has_cc' => $this->faker->boolean(),
            'dash' => $this->faker->boolean(),
            'poke' => $this->faker->boolean(),
            'can_one_shot' => $this->faker->boolean(),
            'late_game' => $this->faker->boolean(),
            'is_good_against_attack_damage' => $this->faker->numberBetween(0, 3),
            'is_good_against_magic_damage' => $this->faker->numberBetween(0, 3),
            'is_good_against_shield' => $this->faker->numberBetween(0, 3),
            'is_good_against_heals' => $this->faker->numberBetween(0, 3),
            'is_good_against_tanky' => $this->faker->numberBetween(0, 3),
            'is_good_against_squish' => $this->faker->numberBetween(0, 3),
            'is_good_against_has_cc' => $this->faker->numberBetween(0, 3),
            'is_good_against_dash' => $this->faker->numberBetween(0, 3),
            'is_good_against_poke' => $this->faker->numberBetween(0, 3),
            'is_good_against_can_one_shot' => $this->faker->numberBetween(0, 3),
            'is_good_against_late_game' => $this->faker->numberBetween(0, 3),
        ];
    }
}
