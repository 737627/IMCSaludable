<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $foods = Food::all();
        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        return view('foods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'calories' => 'required|numeric',
            'proteins' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'fats' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required|string',
        ]);

        Food::create($validated);

        return redirect()->route('foods.index');
    }

    public function show(Food $food)
    {
        return view('foods.show', compact('food'));
    }

    public function edit(Food $food)
    {
        return view('foods.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'type' => 'sometimes|string',
            'calories' => 'sometimes|numeric',
            'proteins' => 'sometimes|numeric',
            'carbohydrates' => 'sometimes|numeric',
            'fats' => 'sometimes|numeric',
            'quantity' => 'sometimes|numeric',
            'description' => 'sometimes|string',
        ]);

        $food->update($validated);

        return redirect()->route('foods.index');
    }

    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('foods.index');
    }
}
