<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Food;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();
        return view('meals.index', compact('meals'));
    }

    public function create()
    {
        $foods = Food::all();
        return view('meals.create', compact('foods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meal_type' => 'required|in:desayuno,almuerzo,cena',
            'description' => 'nullable|string',
            'foods' => 'required|array',
            'foods.*' => 'required|exists:foods,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $meal = Meal::create([
            'name' => $validated['name'],
            'meal_type' => $validated['meal_type'],
            'description' => $validated['description'],
        ]);

        $foods = $validated['foods'];
        $quantities = $validated['quantities'];

        $totalProteins = 0;
        $totalCarbohydrates = 0;
        $totalFats = 0;

        foreach ($foods as $index => $foodId) {
            $food = Food::find($foodId);
            $quantity = $quantities[$index];

            // Calcular los valores por la cantidad en gramos
            $totalProteins += ($food->proteins * $quantity) / 100;
            $totalCarbohydrates += ($food->carbohydrates * $quantity) / 100;
            $totalFats += ($food->fats * $quantity) / 100;

            $meal->foods()->attach($foodId, ['quantity' => $quantity]);
        }

        // Calcular las calorías basadas en proteínas, carbohidratos y grasas
        $totalCalories = ($totalProteins * 4) + ($totalCarbohydrates * 4) + ($totalFats * 9);

        $meal->update([
            'calories' => $totalCalories,
            'proteins' => $totalProteins,
            'carbohydrates' => $totalCarbohydrates,
            'fats' => $totalFats,
        ]);

        return redirect()->route('meals.index')->with('success', 'Comida creada exitosamente.');
    }

    public function show(Meal $meal)
    {
        return view('meals.show', compact('meal'));
    }

    public function edit(Meal $meal)
    {
        $foods = Food::all();
        return view('meals.edit', compact('meal', 'foods'));
    }

    public function update(Request $request, Meal $meal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meal_type' => 'required|in:desayuno,almuerzo,cena',
            'description' => 'nullable|string',
            'foods' => 'required|array',
            'foods.*' => 'required|exists:foods,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $meal->update([
            'name' => $validated['name'],
            'meal_type' => $validated['meal_type'],
            'description' => $validated['description'],
        ]);

        $meal->foods()->detach();

        $foods = $validated['foods'];
        $quantities = $validated['quantities'];

        $totalProteins = 0;
        $totalCarbohydrates = 0;
        $totalFats = 0;

        foreach ($foods as $index => $foodId) {
            $food = Food::find($foodId);
            $quantity = $quantities[$index];

            // Calcular los valores por la cantidad en gramos
            $totalProteins += ($food->proteins * $quantity) / 100;
            $totalCarbohydrates += ($food->carbohydrates * $quantity) / 100;
            $totalFats += ($food->fats * $quantity) / 100;

            $meal->foods()->attach($foodId, ['quantity' => $quantity]);
        }

        // Calcular las calorías basadas en proteínas, carbohidratos y grasas
        $totalCalories = ($totalProteins * 4) + ($totalCarbohydrates * 4) + ($totalFats * 9);

        $meal->update([
            'calories' => $totalCalories,
            'proteins' => $totalProteins,
            'carbohydrates' => $totalCarbohydrates,
            'fats' => $totalFats,
        ]);

        return redirect()->route('meals.index')->with('success', 'Comida actualizada exitosamente.');
    }

    public function destroy(Meal $meal)
    {
        $meal->delete();

        return redirect()->route('meals.index')->with('success', 'Comida eliminada exitosamente.');
    }
}
