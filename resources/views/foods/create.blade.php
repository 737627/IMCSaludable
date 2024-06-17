
@extends('layouts.app')

@section('title', 'Crear Alimento')

@section('content')
<div class="container">
    <h1>Crear Alimento</h1>
    <form method="POST" action="{{ route('foods.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Alimento</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="calories">Calorías</label>
            <input type="number" class="form-control" id="calories" name="calories" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="proteins">Proteínas (g)</label>
            <input type="number" class="form-control" id="proteins" name="proteins" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="carbohydrates">Carbohidratos (g)</label>
            <input type="number" class="form-control" id="carbohydrates" name="carbohydrates" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="fats">Grasas (g)</label>
            <input type="number" class="form-control" id="fats" name="fats" step="0.1" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Alimento</button>
    </form>
</div>
@endsection
