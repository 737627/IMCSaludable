@extends('layouts.app')

@section('title', 'Editar Comida')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Editar Comida</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('meals.update', $meal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $meal->name }}" required>
                </div>
                <div class="form-group">
                    <label for="meal_type">Tipo de Comida</label>
                    <select class="form-control" id="meal_type" name="meal_type" required>
                        <option value="desayuno" {{ $meal->meal_type == 'desayuno' ? 'selected' : '' }}>Desayuno</option>
                        <option value="almuerzo" {{ $meal->meal_type == 'almuerzo' ? 'selected' : '' }}>Almuerzo</option>
                        <option value="cena" {{ $meal->meal_type == 'cena' ? 'selected' : '' }}>Cena</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" name="description">{{ $meal->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="calories">Calorías</label>
                    <input type="number" class="form-control" id="calories" name="calories" value="{{ $meal->calories }}">
                </div>
                <div class="form-group">
                    <label for="proteins">Proteínas</label>
                    <input type="number" class="form-control" id="proteins" name="proteins" value="{{ $meal->proteins }}">
                </div>
                <div class="form-group">
                    <label for="carbohydrates">Carbohidratos</label>
                    <input type="number" class="form-control" id="carbohydrates" name="carbohydrates" value="{{ $meal->carbohydrates }}">
                </div>
                <div class="form-group">
                    <label for="fats">Grasas</label>
                    <input type="number" class="form-control" id="fats" name="fats" value="{{ $meal->fats }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Actualizar Comida</button>
            </form>
        </div>
    </div>
</div>
@endsection
