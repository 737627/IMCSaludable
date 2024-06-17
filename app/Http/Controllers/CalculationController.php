<?php

namespace App\Http\Controllers;

class CalculationController extends Controller
{
    public function calculateIMC($weight, $height)
    {
        return $weight / ($height * $height);
    }

    public function calculateBodyFat($imc, $age, $gender)
    {
        return (1.20 * $imc) + (0.23 * $age) - (10.8 * $gender) - 5.4;
    }

    public function classifyIMC($imc)
    {
        if ($imc < 18.5) {
            return 'Peso insuficiente';
        } elseif ($imc < 24.9) {
            return 'Normopeso';
        } elseif ($imc < 29.9) {
            return 'Sobrepeso grado I';
        } elseif ($imc < 34.9) {
            return 'Obesidad tipo I';
        } elseif ($imc < 39.9) {
            return 'Obesidad tipo II';
        } elseif ($imc < 49.9) {
            return 'Obesidad tipo III (mórbida)';
        } else {
            return 'Obesidad tipo IV (extrema)';
        }
    }

    public function calculateDailyCalories($weight, $height, $age, $gender, $activityLevel)
    {
        if ($gender == 'female') {
            return (655 + (9.6 * $weight) + (1.8 * $height * 100) - (4.7 * $age)) * $activityLevel;
        } else {
            return (66 + (13.7 * $weight) + (5 * $height * 100) - (6.8 * $age)) * $activityLevel;
        }
    }
}
