<?php

namespace App\Http\Actions\Champion;

use App\Models\Champion;

class UpdateChampionAction
{
    public function __invoke(Champion $champion, array $championData): Champion
    {
        $champion->update($championData);
        activity()
            ->performedOn($champion)
            ->log('Champion updated');
        return $champion;
    }
}
