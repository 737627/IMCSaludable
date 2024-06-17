<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registro
    public function register(Request $request)
    {
        // Validar y crear el usuario
        $validatedData = $request->validate([
            'account_type' => 'required|string|in:admin,patient,nutritionist',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['account_type'],
        ]);

        // Crear un registro en patients si el usuario es un paciente
        if ($user->role === 'patient') {
            Patient::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'age' => 0, 
                'weight' => 0.0,
                'height' => 0.0,
                'gender' => 0,
            ]);
        }

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir a la pantalla adecuada según el tipo de cuenta
        if ($user->role === 'patient') {
            return redirect()->route('patients.create');
        } elseif ($user->role === 'nutritionist') {
            return redirect()->route('dashboard'); 
        } else {
            return redirect()->route('home');
        }
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    // Eliminar cuenta incompleta
    public function deleteIncompleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'patient' && !$user->patient->age) {
            $user->delete();
        }

        return response()->json(['status' => 'Account deleted']);
    }
}
