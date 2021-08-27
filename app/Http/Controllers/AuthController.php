<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials = ["email" => $request->email, "password" => $request->password];
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                "user" => auth()->user(),
                "token" => 'Bearer '.$tokenResult
            ]);
        };
        return response()->json(["error" => "Credenciales inválidas."]);
    }

    public function logout(Request $request) {
        Auth::logout();
        return response()->json(["error" => "Sesión finalizada."]);
    }
}
