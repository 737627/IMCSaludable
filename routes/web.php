<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\IMCController;
use App\Http\Middleware\CheckPatientData;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/iniciarSesion', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/iniciarSesion', [AuthController::class, 'login']);
Route::get('/registrarse', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/registrarse', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('patients', PatientController::class);
Route::resource('foods', FoodController::class)->only([
    'index', 'show'
]);

Route::middleware(['auth', 'check.patient.data'])->group(function () {
    Route::resource('foods', FoodController::class)->except([
        'index', 'show'
    ]);
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::post('/patients/register-details', [PatientController::class, 'store'])->name('patients.register-details');
    Route::post('/patient/setCheatMealDay', [PatientController::class, 'setCheatMealDay'])->name('patient.setCheatMealDay');
    Route::post('/patient/addWeightRecord', [PatientController::class, 'addWeightRecord'])->name('patient.addWeightRecord');
    Route::post('/dashboard/add-meal/{type}', [PatientController::class, 'addMeal'])->name('patient.addMeal');
    Route::resource('imc', IMCController::class);
    Route::resource('meals', MealController::class);
    Route::resource('diets', DietController::class); 
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{user}/edit-password', [AdminController::class, 'editPassword'])->name('admin.users.edit-password');
    Route::patch('/admin/users/{user}/update-password', [AdminController::class, 'updatePassword'])->name('admin.users.update-password');
});

// Ruta para eliminar la cuenta si el usuario intenta salir sin completar el registro
Route::post('/delete-incomplete-account', [AuthController::class, 'deleteIncompleteAccount'])->name('delete.incomplete.account');
