<?php

namespace App\Http\Controllers;

use App\Http\Actions\CreateUserAction;
use App\Http\Actions\UpdateUserAction;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

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
        return response()->json(['message' => 'Użytkownik został usunięty.',$user->delete()]);
    }
}
