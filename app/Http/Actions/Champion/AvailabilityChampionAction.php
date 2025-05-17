<?php

namespace App\Http\Actions\Champion;

use App\Models\Champion;

class AvailabilityChampionAction
{
    public function __invoke($champion): Champion{
        $champion->isAvailable = !$champion->isAvailable;
        $champion->save();

        return $champion;
    }
}
