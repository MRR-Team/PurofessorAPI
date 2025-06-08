<?php

namespace App\Http\Actions;

use App\Models\Champion;
use App\Models\Item;

class BestItemsAction
{
    public function __invoke(Champion $enemyChampion, Champion $champion): array
    {
        $itemsList=Item::all();
        $scoredItems=[];

        foreach ($itemsList as $item) {

            if ($item->role == $champion->role) {
                $score = 0;

                if ($enemyChampion->attack_damage   && $champion->attack_damege==$item->attack_damage)      $score += $item->is_good_against_attack_damage;
                if ($enemyChampion->magic_damage    && $champion->magic_damege==$item->magic_damage)        $score += $item->is_good_against_magic_damage;
                if ($enemyChampion->shield          && $champion->shield==$item->shield)                    $score += $item->is_good_against_shield;
                if ($enemyChampion->heals           && $champion->heals==$item->heals)                      $score += $item->is_good_against_heals;
                if ($enemyChampion->tanky           && $champion->tanky==$item->tanky)                      $score += $item->is_good_against_tanky;
                if ($enemyChampion->squishy         && $champion->squishy==$item->squishy)                  $score += $item->is_good_against_squishy;
                if ($enemyChampion->has_cc          && $champion->has_cc==$item->has_cc)                    $score += $item->is_good_against_cc;
                if ($enemyChampion->dash            && $champion->dash==$item->dash)                        $score += $item->is_good_against_dash;
                if ($enemyChampion->poke            && $champion->poke==$item->poke)                        $score += $item->is_good_against_poke;
                if ($enemyChampion->can_one_shot    && $champion->can_one_shot==$item->can_one_shot)        $score += $item->is_good_against_one_shot;
                if ($enemyChampion->late_game       && $champion->late_game==$item->late_game)              $score += $item->is_good_against_late_game;

                $scoredItems[] = ['item' => $item, 'score' => $score];
            }
        }
        usort($scoredItems, fn($a, $b) => $b['score'] <=> $a['score']);
        activity()
            ->useLog('build-search')
            ->withProperties([
                'enemy_champion_id' => $enemyChampion->id,
                'enemy_champion_name' => $enemyChampion->name,
                'champion_id' => $champion->id,
                'champion_name' => $champion->name,
            ])
            ->log("Build search performed with {$enemyChampion->name} and {$champion->name} ");
        return array_slice(array_column($scoredItems, 'item'), 0, 5);
    }
}
