<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DietController;

// Definir rutas de API para pacientes
Route::apiResource('patients', PatientController::class)->names([
    'index' => 'api.patients.index',
    'store' => 'api.patients.store',
    'show' => 'api.patients.show',
    'update' => 'api.patients.update',
    'destroy' => 'api.patients.destroy',
]);

// Definir rutas de API para alimentos
Route::apiResource('foods', FoodController::class)->names([
    'index' => 'api.foods.index',
    'store' => 'api.foods.store',
    'show' => 'api.foods.show',
    'update' => 'api.foods.update',
    'destroy' => 'api.foods.destroy',
]);

// Middleware para rutas que requieren autenticación
Route::middleware(['auth:api'])->group(function () {
    // Ruta para establecer un día de cheat meal
    Route::post('/set-cheat-meal-day', [PatientController::class, 'setCheatMealDay']);
    
    // Definir rutas de API para dietas
    Route::apiResource('diets', DietController::class)->names([
        'index' => 'api.diets.index',
        'store' => 'api.diets.store',
        'show' => 'api.diets.show',
        'update' => 'api.diets.update',
        'destroy' => 'api.diets.destroy',
    ]);
});
