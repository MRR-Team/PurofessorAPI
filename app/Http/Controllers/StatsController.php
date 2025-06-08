<?php

namespace App\Http\Controllers;

use App\Http\Actions\SearchStatsAction;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;

class StatsController extends Controller
{
    public function SearchStats(SearchStatsAction $searchStatsAction): JsonResponse
    {
        return response()->json($searchStatsAction());
    }
    public function Logs(): JsonResponse{
        return response()->json(Activity::latest()->paginate(20) );
    }
}
