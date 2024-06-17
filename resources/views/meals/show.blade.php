@extends('layouts.app')

@section('title', 'Detalles de la Comida')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detalles de la Comida</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $meal->name }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($meal->meal_type) }}</p>
            <p><strong>Descripción:</strong> {{ $meal->description }}</p>
            <p><strong>Calorías:</strong> {{ $meal->calories }}</p>
            <p><strong>Proteínas:</strong> {{ $meal->proteins }}</p>
            <p><strong>Carbohidratos:</strong> {{ $meal->carbohydrates }}</p>
            <p><strong>Grasas:</strong> {{ $meal->fats }}</p>
        </div>
    </div>
</div>
@endsection
