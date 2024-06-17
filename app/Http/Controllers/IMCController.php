<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IMCController extends Controller
{
    // Método para mostrar la vista de cálculo de IMC
    public function index()
    {
        return view('imc.index');
    }

    // Método para manejar el cálculo de IMC
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
        ]);

        $weight = $validated['weight'];
        $height = $validated['height'];
        $imc = $weight / ($height * $height);

        return view('imc.result', compact('imc'));
    }
}
