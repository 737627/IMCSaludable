@extends('layouts.app')

@section('title', 'Lista de Comidas')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Lista de Comidas</h3>
            <a href="{{ route('meals.create') }}" class="btn btn-primary float-right">Agregar Comida</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Calorías</th>
                        <th>Proteínas</th>
                        <th>Carbohidratos</th>
                        <th>Grasas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meals as $meal)
                        <tr>
                            <td>{{ $meal->name }}</td>
                            <td>{{ ucfirst($meal->meal_type) }}</td>
                            <td>{{ $meal->calories }}</td>
                            <td>{{ $meal->proteins }}</td>
                            <td>{{ $meal->carbohydrates }}</td>
                            <td>{{ $meal->fats }}</td>
                            <td>
                                <a href="{{ route('meals.edit', $meal->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('meals.destroy', $meal->id) }}" method="POST" style="display:inline;">
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
    </div>
</div>
@endsection
