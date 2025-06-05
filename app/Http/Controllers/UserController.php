<?php

namespace App\Http\Controllers;

use App\Http\Actions\User\CreateUserAction;
use App\Http\Actions\User\UpdateUserAction;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        return response()->json(['message' => 'Użytkownik utworzony pomyślnie',
            'user' => $createUserAction($request->validated())], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdateUserRequest $request, UpdateUserAction $updateUserAction): JsonResponse
    {
        return response()->json(['message' => 'Użytkownik zaktualizowany pomyślnie',
            'user' => $updateUserAction($user,$request->validated())], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        return response()->json(['message' => 'Użytkownik został usunięty.',$user->delete()],204);
    }
}
