<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RiotStatusController extends Controller
{
    public function show(string $region)
    {
        $validRegions = ['euw1', 'na1', 'eun1', 'kr', 'br1', 'jp1', 'oc1', 'ru', 'tr1'];
        if (!in_array($region, $validRegions)) {
            return response()->json(['error' => 'Invalid region specified.'], 400);
        }

        $apiKey = config('services.riot.key');
        $region = strtoupper($region);
        $url = "https://{$region}.api.riotgames.com/lol/status/v4/platform-data";

        $response = Http::withHeaders([
            'X-Riot-Token' => $apiKey,
            'Accept' => 'application/json',
        ])->get($url);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Could not fetch Riot server status.',
                'status_code' => $response->status()
            ], $response->status());
        }

        return response()->json($response->json());
    }
}
