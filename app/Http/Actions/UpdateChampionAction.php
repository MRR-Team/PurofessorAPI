<?php

namespace App\Http\Actions;

use App\Models\Champion;

class UpdateChampionAction
{
    public function __invoke(Champion $champion, array $championData): Champion
    {
        $champion->update($championData);
        return $champion;
    }
}
