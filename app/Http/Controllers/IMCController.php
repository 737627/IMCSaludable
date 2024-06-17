<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IMCController extends Controller
{
    // M�todo para mostrar la vista de c�lculo de IMC
    public function index()
    {
        return view('imc.index');
    }

    // M�todo para manejar el c�lculo de IMC
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
