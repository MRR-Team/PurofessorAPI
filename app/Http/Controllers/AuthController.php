<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Szukanie użytkownika
        $user = User::where('email', $request->email)->first();

        // Sprawdzenie poprawności hasła
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Nieprawidłowe dane logowania.'
            ], 401);
        }

        // Tworzenie tokena
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Zalogowano pomyślnie.',
            'token' => $token,
            'user' => $user,
        ]);
    }
}
