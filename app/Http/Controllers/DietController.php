<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;

class DietController extends Controller
{
    public function index()
    {
        $diets = Diet::all();
        return view('diets.index', compact('diets'));
    }

    public function create()
    {
        return view('diets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'nutritionist_id' => 'required|exists:users,id',
            'meal_type' => 'required|string',
            'food_name' => 'required|string',
            'calories' => 'required|numeric',
            'proteins' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        Diet::create($validated);

        return redirect()->route('diets.index');
    }

    public function show(Diet $diet)
    {
        return view('diets.show', compact('diet'));
    }

    public function edit(Diet $diet)
    {
        return view('diets.edit', compact('diet'));
    }

    public function update(Request $request, Diet $diet)
    {
        $validated = $request->validate([
            'meal_type' => 'sometimes|string',
            'food_name' => 'sometimes|string',
            'calories' => 'sometimes|numeric',
            'proteins' => 'sometimes|numeric',
            'carbohydrates' => 'sometimes|numeric',
            'fats' => 'sometimes|numeric',
            'quantity' => 'sometimes|numeric',
        ]);

        $diet->update($validated);

        return redirect()->route('diets.index');
    }

    public function destroy(Diet $diet)
    {
        $diet->delete();
        return redirect()->route('diets.index');
    }
}
