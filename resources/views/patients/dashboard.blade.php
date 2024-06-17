@extends('layouts.app')

@section('title', 'Dashboard de ' . Auth::user()->name)

@section('content')
<div class="container">
    <h1>Dashboard de {{ Auth::user()->name }}</h1>

    <!-- Sección de comidas -->
    <h2>Mi Diario De Alimentos</h2>
    <div class="meals-section">
        <h3>Desayuno</h3>
        <form method="POST" action="{{ route('patient.addMeal', 'desayuno') }}">
            @csrf
            <select name="meal_id" required>
                <option value="">Seleccione un alimento</option>
                @foreach ($meals->where('meal_type', 'desayuno') as $meal)
                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Añadir Artículo</button>
        </form>
        <ul>
            @foreach ($diets->where('type', 'desayuno') as $meal)
                <li>{{ $meal->name }}: {{ $meal->calories }} cal, {{ $meal->proteins }}g proteínas, {{ $meal->carbohydrates }}g carbohidratos, {{ $meal->fats }}g grasas</li>
            @endforeach
        </ul>

        <h3>Almuerzo</h3>
        <form method="POST" action="{{ route('patient.addMeal', 'almuerzo') }}">
            @csrf
            <select name="meal_id" required>
                <option value="">Seleccione un alimento</option>
                @foreach ($meals->where('meal_type', 'almuerzo') as $meal)
                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Añadir Artículo</button>
        </form>
        <ul>
            @foreach ($diets->where('type', 'almuerzo') as $meal)
                <li>{{ $meal->name }}: {{ $meal->calories }} cal, {{ $meal->proteins }}g proteínas, {{ $meal->carbohydrates }}g carbohidratos, {{ $meal->fats }}g grasas</li>
            @endforeach
        </ul>

        <h3>Cena</h3>
        <form method="POST" action="{{ route('patient.addMeal', 'cena') }}">
            @csrf
            <select name="meal_id" required>
                <option value="">Seleccione un alimento</option>
                @foreach ($meals->where('meal_type', 'cena') as $meal)
                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Añadir Artículo</button>
        </form>
        <ul>
            @foreach ($diets->where('type', 'cena') as $meal)
                <li>{{ $meal->name }}: {{ $meal->calories }} cal, {{ $meal->proteins }}g proteínas, {{ $meal->carbohydrates }}g carbohidratos, {{ $meal->fats }}g grasas</li>
            @endforeach
        </ul>

        <h4>Total Diario</h4>
        <p>Calorías: {{ $diets->sum('calories') }} cal</p>
        <p>Proteínas: {{ $diets->sum('proteins') }}g</p>
        <p>Carbohidratos: {{ $diets->sum('carbohydrates') }}g</p>
        <p>Grasas: {{ $diets->sum('fats') }}g</p>
    </div>

    <!-- Sección de cheat meal -->
    <h2>Cheat Meal Day</h2>
    <form method="POST" action="{{ route('patient.setCheatMealDay') }}">
        @csrf
        <label for="cheatMealDay">Selecciona un día:</label>
        <input type="date" name="date" id="cheatMealDay" required>
        <button type="submit" class="btn btn-primary">Programar Cheat Meal</button>
    </form>
    @if ($cheatMealDay)
        <p>Cheat Meal programado para: {{ $cheatMealDay->cheat_meal_day }}</p>
    @else
        <p>No hay días de cheat meal programados.</p>
    @endif

    <!-- Sección de peso -->
    <h2>La Historia De Mi Peso</h2>
    <form method="POST" action="{{ route('patient.addWeightRecord') }}">
        @csrf
        <label for="weight">Peso Actual (kg):</label>
        <input type="number" name="weight" id="weight" step="0.1" required>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <h3>Historial de Peso</h3>
    @if ($weightRecords->isEmpty())
        <p>No hay registros de peso.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Peso (kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weightRecords as $record)
                    <tr>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->weight }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <canvas id="weightChart" width="400" height="200"></canvas>
        <!-- Cambiar las URLs de Chart.js y el adaptador de fechas -->
        <script src="https://unpkg.com/chart.js@3.7.1/dist/chart.min.js"></script>
        <script src="https://unpkg.com/chartjs-adapter-date-fns@2.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('weightChart').getContext('2d');
                const weightData = {
                    labels: @json($weightRecords->pluck('date')),
                    datasets: [{
                        label: 'Peso (kg)',
                        data: @json($weightRecords->pluck('weight')),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false,
                    }]
                };

                const weightChart = new Chart(ctx, {
                    type: 'line',
                    data: weightData,
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                },
                                title: {
                                    display: true,
                                    text: 'Fecha'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Peso (kg)'
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</div>
@endsection
