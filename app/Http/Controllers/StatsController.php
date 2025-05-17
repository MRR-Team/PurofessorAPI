<?php

namespace App\Http\Controllers;

use App\Http\Actions\SearchStatsAction;
use Illuminate\Http\JsonResponse;

class StatsController extends Controller
{
    public function __invoke(SearchStatsAction $searchStatsAction): JsonResponse
    {
        return response()->json($searchStatsAction());
    }
}
