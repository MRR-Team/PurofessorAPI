<?php

namespace App\Http\Controllers;

use App\Http\Actions\Champion\AvailabilityChampionAction;
use App\Http\Actions\Champion\CreateChampionAction;
use App\Http\Actions\Champion\UpdateChampionAction;
use App\Http\Requests\Champion\CreateChampionRequest;
use App\Http\Requests\Champion\UpdateChampionRequest;
use App\Models\Champion;
use Illuminate\Http\JsonResponse;

class ChampionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        return response()->json(Champion::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChampionRequest $request, CreateChampionAction $createChampionAction) : JsonResponse
    {
        return response()->json(['message' => 'utworzono pomyślnie',
            'champion' => $createChampionAction($request->validated())], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Champion $champion) : JsonResponse
    {
        return response()->json($champion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Champion $champion, UpdateChampionRequest $request, UpdateChampionAction $updateChampionAction) : JsonResponse
    {
        return response()->json(['message' => 'zaktualizowano pomyślnie',
            'champion' => $updateChampionAction($champion,$request->validated())], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Champion $champion) : JsonResponse
    {
        return response()->json(['message' => 'Bohater został usunięty.',$champion->delete()]);
    }

    public function toggleChampionAvailability(Champion $champion, AvailabilityChampionAction $championAvailabilityAction) : JsonResponse
    {
        return response()->json($championAvailabilityAction($champion));
    }

}
