<?php

namespace App\Http\Actions\Champion;

use App\Models\Champion;

class CreateChampionAction
{
    public function __invoke(array $championData): Champion
    {
        $champion = new Champion($championData);
        $champion->save();

        activity()
            ->performedOn($champion)
            ->log('New champion created');
        return $champion;
    }
}
