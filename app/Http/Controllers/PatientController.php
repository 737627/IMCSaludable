<?php
namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Diet;
use App\Models\CheatMealDay;
use App\Models\Meal;
use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'gender' => 'required|integer'
        ]);

        $bmi = $data['weight'] / ($data['height'] * $data['height']);
        $body_fat_percentage = (1.20 * $bmi) + (0.23 * $data['age']) - (10.8 * $data['gender']) - 5.4;

        $data['bmi'] = $bmi;
        $data['body_fat_percentage'] = $body_fat_percentage;
        $data['user_id'] = Auth::id(); // Asigna el user_id

        Patient::create($data);

        return redirect()->route('patients.index');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'gender' => 'required|integer'
        ]);

        $bmi = $data['weight'] / ($data['height'] * $data['height']);
        $body_fat_percentage = (1.20 * $bmi) + (0.23 * $data['age']) - (10.8 * $data['gender']) - 5.4;

        $data['bmi'] = $bmi;
        $data['body_fat_percentage'] = $body_fat_percentage;

        $patient->update($data);

        return redirect()->route('patients.index');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index');
    }

    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $patient = Patient::where('user_id', $user->id)->first();

        if (!$patient) {
            return redirect('/'); // Redirigir a la página de inicio si no se encuentra el paciente
        }

        $diets = Diet::where('patient_id', $patient->id)->get();
        $cheatMealDay = CheatMealDay::where('patient_id', $patient->id)->first();
        $weightRecords = Weight::where('patient_id', $patient->id)->orderBy('date', 'asc')->get();
        $meals = Meal::all();

        return view('patients.dashboard', compact('diets', 'cheatMealDay', 'weightRecords', 'meals'));
    }

    public function setCheatMealDay(Request $request)
    {
        $validated = $request->validate(['date' => 'required|date']);
        $patient = Patient::where('user_id', Auth::id())->first();

        CheatMealDay::updateOrCreate(
            ['patient_id' => $patient->id],
            ['cheat_meal_day' => $validated['date']]
        );

        return response()->json(['success' => true]);
    }

    public function addWeightRecord(Request $request)
    {
        $validated = $request->validate(['weight' => 'required|numeric']);
        $patient = Patient::where('user_id', Auth::id())->first();

        Weight::create([
            'patient_id' => $patient->id,
            'weight' => $validated['weight'],
            'date' => now(),
        ]);

        return redirect()->route('patient.dashboard');
    }

    public function addMeal(Request $request, $type)
    {
        $validated = $request->validate(['meal_id' => 'required|exists:meals,id']);
        $patient = Patient::where('user_id', Auth::id())->first();

        $meal = Meal::find($validated['meal_id']);

        Diet::create([
            'patient_id' => $patient->id,
            'meal_id' => $meal->id,
            'type' => $type,
            'calories' => $meal->calories,
            'proteins' => $meal->proteins,
            'carbohydrates' => $meal->carbohydrates,
            'fats' => $meal->fats,
        ]);

        return redirect()->route('patient.dashboard');
    }
}
