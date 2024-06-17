@extends('layouts.app')

@section('title', 'Panel de Paciente')

@section('content')
<div class="container">
    <h2>Panel de Paciente</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <h3>Desayuno</h3>
            @include('partials.meal_list', ['mealType' => 'desayuno'])
        </div>
        <div class="col-md-4">
            <h3>Almuerzo</h3>
            @include('partials.meal_list', ['mealType' => 'almuerzo'])
        </div>
        <div class="col-md-4">
            <h3>Cena</h3>
            @include('partials.meal_list', ['mealType' => 'cena'])
        </div>
    </div>

    <div class="mb-4">
        <h3>Progreso del IMC</h3>
        <a href="{{ route('imc.index') }}" class="btn btn-primary">Ver Progreso del IMC</a>
    </div>

    <div class="mb-4">
        <h3>Calendario Cheat Meal</h3>
        <input type="date" id="cheat-meal-date" class="form-control" onchange="setCheatMealDay(this.value)">
    </div>
</div>

<script>
    function setCheatMealDay(date) {
        fetch(`/api/set-cheat-meal-day`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ date: date })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Día de cheat meal establecido.');
            } else {
                alert('Error al establecer el día de cheat meal.');
            }
        });
    }
</script>
@endsection
