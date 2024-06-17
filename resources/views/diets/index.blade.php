@extends('layouts.app')

@section('title', 'Lista de Dietas')

@section('content')
<div class="container">
    <h1>Lista de Dietas</h1>
    <a href="{{ route('diets.create') }}" class="btn btn-primary">Agregar Dieta</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Paciente</th>
                <th>Nombre del Nutricionista</th>
                <th>Tipo de Comida</th>
                <th>Nombre del Alimento</th>
                <th>Calorías</th>
                <th>Proteínas</th>
                <th>Carbohidratos</th>
                <th>Grasas</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diets as $diet)
            <tr>
                <td>{{ $diet->id }}</td>
                <td>{{ $diet->patient->name }}</td>
                <td>{{ $diet->nutritionist->name }}</td>
                <td>{{ $diet->meal_type }}</td>
                <td>{{ $diet->food_name }}</td>
                <td>{{ $diet->calories }}</td>
                <td>{{ $diet->proteins }}</td>
                <td>{{ $diet->carbohydrates }}</td>
                <td>{{ $diet->fats }}</td>
                <td>{{ $diet->quantity }}</td>
                <td>
                    <a href="{{ route('diets.edit', $diet->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('diets.destroy', $diet->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
