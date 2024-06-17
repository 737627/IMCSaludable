// resources/views/patients/index.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Pacientes</title>
</head>
<body>
    <h1>Lista de Pacientes</h1>
    <a href="{{ route('patients.create') }}">Agregar Paciente</a>
    <ul>
        @foreach($patients as $patient)
            <li>
                <a href="{{ route('patients.show', $patient) }}">{{ $patient->name }}</a>
                <form action="{{ route('patients.destroy', $patient) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
