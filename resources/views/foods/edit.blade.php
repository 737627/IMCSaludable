@extends('layouts.app')

@section('title', 'Editar Alimento')

@section('content')
<div class="container">
    <h1>Editar Alimento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('foods.update', $food->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre del Alimento:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $food->name) }}" required>
        </div>

        <div class="form-group">
            <label for="calories">Calorías:</label>
            <input type="number" name="calories" id="calories" class="form-control" value="{{ old('calories', $food->calories) }}" required>
        </div>

        <div class="form-group">
            <label for="proteins">Proteínas (g):</label>
            <input type="number" name="proteins" id="proteins" class="form-control" value="{{ old('proteins', $food->proteins) }}" required>
        </div>

        <div class="form-group">
            <label for="carbohydrates">Carbohidratos (g):</label>
            <input type="number" name="carbohydrates" id="carbohydrates" class="form-control" value="{{ old('carbohydrates', $food->carbohydrates) }}" required>
        </div>

        <div class="form-group">
            <label for="fats">Grasas (g):</label>
            <input type="number" name="fats" id="fats" class="form-control" value="{{ old('fats', $food->fats) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
