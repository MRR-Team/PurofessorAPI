<?php

namespace App\Http\Actions;

use App\Models\Champion;

class BestCounterAction
{
    public function __invoke(String $role, Champion $enemyChampion): array
    {
            $maxScore = 0;
            $championsList=Champion::all();
            $bestChampions = [];

            foreach ($championsList as $champion) {

                if ($enemyChampion->id !== $champion->id || $champion->role !== $role) {
                    $score = 0;

                    if ($enemyChampion->attack_damage) $score += $champion->is_good_against_attack_damage;
                    if ($enemyChampion->magic_damage) $score += $champion->is_good_against_magic_damage;
                    if ($enemyChampion->shield)       $score += $champion->is_good_against_shield;
                    if ($enemyChampion->heals)        $score += $champion->is_good_against_heals;
                    if ($enemyChampion->tanky)        $score += $champion->is_good_against_tanky;
                    if ($enemyChampion->squishy)      $score += $champion->is_good_against_squishy;
                    if ($enemyChampion->has_cc)       $score += $champion->is_good_against_cc;
                    if ($enemyChampion->dash)         $score += $champion->is_good_against_dash;
                    if ($enemyChampion->poke)         $score += $champion->is_good_against_poke;
                    if ($enemyChampion->can_one_shot) $score += $champion->is_good_against_one_shot;
                    if ($enemyChampion->late_game)    $score += $champion->is_good_against_late_game;

                    if ($score > $maxScore) {
                        $maxScore = $score;
                        $bestChampions = [Champion::getById($champion->id, $championsList)];
                    } elseif ($score === $maxScore) {
                        $bestChampions[] = Champion::getById($champion->id, $championsList);
                    }
                }
            }
            return $bestChampions;
    }
}
