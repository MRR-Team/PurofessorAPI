<?php

namespace App\Http\Controllers;

use App\Http\Actions\BestItemsAction;
use App\Models\Champion;
use Illuminate\Http\JsonResponse;

class BuildController
{
    public function __invoke(BestItemsAction $bestItemsAction, Champion $enemyChampion, Champion $champion):JsonResponse{
        return response()->json($bestItemsAction($enemyChampion, $champion));
    }
}
