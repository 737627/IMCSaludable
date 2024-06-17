@extends('layouts.app')

@section('title', 'Lista de Alimentos')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Alimentos</h1>

        @auth
        <a href="{{ route('foods.create') }}" class="btn btn-primary mb-3">Agregar Alimento</a>
        @endauth

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Calorías</th>
                    <th>Proteínas</th>
                    <th>Carbohidratos</th>
                    <th>Grasas</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    @auth
                    <th>Acciones</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($foods as $food)
                <tr>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->type }}</td>
                    <td>{{ $food->calories }}</td>
                    <td>{{ $food->proteins }}</td>
                    <td>{{ $food->carbohydrates }}</td>
                    <td>{{ $food->fats }}</td>
                    <td>{{ $food->quantity }}</td>
                    <td>{{ $food->description }}</td>
                    @auth
                    <td>
                        <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('foods.destroy', $food->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
