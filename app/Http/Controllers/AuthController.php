<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            return response()->json([
                'message' => 'Username atau password salah!'
            ], 401);
        }
    }

    // Function logout
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logout berhasil!'
        ], 200);
    }
}
