<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Usuario eliminado con éxito.');
    }

    public function editPassword(User $user)
    {
        return view('admin.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Contraseña actualizada con éxito.');
    }
}
