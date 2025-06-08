<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'name',
        'role',
        'attack_damage',
        'magic_damage',
        'shield',
        'heals',
        'tanky',
        'squishy',
        'has_cc',
        'dash',
        'poke',
        'can_one_shot',
        'late_game',
        'is_good_against_attack_damage',
        'is_good_against_magic_damage',
        'is_good_against_shield',
        'is_good_against_heals',
        'is_good_against_tanky',
        'is_good_against_squish',
        'is_good_against_has_cc',
        'is_good_against_dash',
        'is_good_against_poke',
        'is_good_against_can_one_shot',
        'is_good_against_late_game',
    ];
    public static function getById($id, $itemsList)
    {
        return collect($itemsList)->firstWhere('id', $id);
    }
}
