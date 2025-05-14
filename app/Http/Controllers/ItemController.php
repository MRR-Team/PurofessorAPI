<?php

namespace App\Http\Controllers;

use App\Http\Actions\Item\CreateItemAction;
use App\Http\Actions\Item\UpdateItemAction;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Item::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateItemRequest $request, CreateItemAction $createItemAction): JsonResponse
    {
        return response()->json([
            'message' => 'Przedmiot utworzony pomyślnie',
            'item' => $createItemAction($request->validated())
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): JsonResponse
    {
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Item $item, UpdateItemRequest $request, UpdateItemAction $updateItemAction): JsonResponse
    {
        return response()->json([
            'message' => 'Przedmiot zaktualizowany pomyślnie',
            'item' => $updateItemAction($item, $request->validated())
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): JsonResponse
    {
        $item->delete();

        return response()->json([
            'message' => 'Przedmiot został usunięty.'
        ]);
    }
}
