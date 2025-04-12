<?php

namespace App\Http\Controllers;

use App\Http\Actions\CreateUserAction;
use App\Http\Requests\UserRequest;
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
        return response()->json(['']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request, CreateUserAction $createUserAction): JsonResponse
    {
        $user = $createUserAction($request->validated());
        return response()->json(['message' => 'Użytkownik utworzony pomyślnie', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
