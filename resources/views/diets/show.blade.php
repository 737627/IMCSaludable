@extends('layouts.app')

@section('title', 'Detalle de la Dieta')

@section('content')
<div class="container">
    <h1>Detalle de la Dieta</h1>
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $diet->id }}</td>
        </tr>
        <tr>
            <th>Nombre del Paciente:</th>
            <td>{{ $diet->patient->name }}</td>
        </tr>
        <tr>
            <th>Nombre del Nutricionista:</th>
            <td>{{ $diet->nutritionist->name }}</td>
        </tr>
        <tr>
            <th>Tipo de Comida:</th>
            <td>{{ $diet->meal_type }}</td>
        </tr>
        <tr>
            <th>Nombre del Alimento:</th>
            <td>{{ $diet->food_name }}</td>
        </tr>
        <tr>
            <th>Calorías:</th>
            <td>{{ $diet->calories }}</td>
        </tr>
        <tr>
            <th>Proteínas:</th>
            <td>{{ $diet->proteins }}</td>
        </tr>
        <tr>
            <th>Carbohidratos:</th>
            <td>{{ $diet->carbohydrates }}</td>
        </tr>
        <tr>
            <th>Grasas:</th>
            <td>{{ $diet->fats }}</td>
        </tr>
        <tr>
            <th>Cantidad:</th>
            <td>{{ $diet->quantity }}</td>
        </tr>
    </table>
    <a href="{{ route('diets.edit', $diet->id) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('diets.destroy', $diet->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>
@endsection
