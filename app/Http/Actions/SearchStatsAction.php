<?php

namespace App\Http\Actions;

use App\Models\Champion;
use Spatie\Activitylog\Models\Activity;

class SearchStatsAction
{
    public function __invoke()
    {
        $activities = Activity::where('log_name', 'counter-search')->get();

        $stats = [];

        foreach ($activities as $activity) {
            $championId = $activity->properties['enemy_champion_id'] ?? null;

            if ($championId) {
                if (!isset($stats[$championId])) {
                    $stats[$championId] = 0;
                }
                $stats[$championId]++;
            }
        }

        return collect($stats)
            ->map(function ($total, $championId) {
                $champion = Champion::find($championId);
                return $champion ? [
                    'champion' => $champion,
                    'total' => $total,
                ] : null;
            })
            ->filter()
            ->values();
    }
}
