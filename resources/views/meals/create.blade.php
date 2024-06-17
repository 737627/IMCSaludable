@extends('layouts.app')

@section('title', 'Crear Comida')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Crear Comida</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('meals.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                </div>
                <div class="form-group">
                    <label for="meal_type">Tipo de Comida</label>
                    <select class="form-control" id="meal_type" name="meal_type" required>
                        <option value="desayuno">Desayuno</option>
                        <option value="almuerzo">Almuerzo</option>
                        <option value="cena">Cena</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" class="form-control" name="description"></textarea>
                </div>
                <div id="foods-container">
                    <div class="form-row">
                        <div class="col">
                            <label for="foods">Alimentos</label>
                            <select class="form-control" name="foods[]" required>
                                <option value="">Seleccionar Alimento</option>
                                @foreach($foods as $food)
                                    <option value="{{ $food->id }}">{{ $food->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="quantities">Cantidad (gramos)</label>
                            <input type="number" class="form-control" name="quantities[]" placeholder="Cantidad en gramos" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-success add-food">+</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Crear Comida</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.add-food').addEventListener('click', function () {
        const container = document.getElementById('foods-container');
        const newRow = document.createElement('div');
        newRow.classList.add('form-row', 'mt-2');
        
        newRow.innerHTML = `
            <div class="col">
                <select class="form-control" name="foods[]" required>
                    <option value="">Seleccionar Alimento</option>
                    @foreach($foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input type="number" class="form-control" name="quantities[]" placeholder="Cantidad en gramos" required>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger remove-food">-</button>
            </div>
        `;
        
        container.appendChild(newRow);

        newRow.querySelector('.remove-food').addEventListener('click', function () {
            container.removeChild(newRow);
        });
    });
});
</script>
@endsection
