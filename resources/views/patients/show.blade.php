// resources/views/patients/show.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Paciente</title>
</head>
<body>
    <h1>{{ $patient->name }}</h1>
    <p>Edad: {{ $patient->age }}</p>
    <p>Peso: {{ $patient->weight }}</p>
    <p>Altura: {{ $patient->height }}</p>
    <p>IMC: {{ $patient->bmi }}</p>
    <p>Porcentaje de Grasa Corporal: {{ $patient->body_fat_percentage }}</p>
    <a href="{{ route('patients.edit', $patient) }}">Editar</a>
    <form action="{{ route('patients.destroy', $patient) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
</body>
</html>
