@extends('layouts.app')

@section('title', 'Registrar Datos del Paciente')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Registrar Datos del Paciente</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="gender">Sexo</label>
                    <div>
                        <input type="radio" id="male" name="gender" value="male" required>
                        <label for="male">Masculino</label>
                        <input type="radio" id="female" name="gender" value="female" required>
                        <label for="female">Femenino</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="weight">Peso Actual (kg)</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>
                <div class="form-group">
                    <label for="height">Altura (cm)</label>
                    <input type="number" class="form-control" id="height" name="height" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Fecha de Nacimiento</label>
                    <div class="d-flex">
                        <select class="form-control mr-2" id="birth_month" name="birth_month" required>
                            <option value="">Mes</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select class="form-control mr-2" id="birth_day" name="birth_day" required>
                            <option value="">Día</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select class="form-control" id="birth_year" name="birth_year" required>
                            <option value="">Año</option>
                            @for ($i = date('Y'); $i >= 1900; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="activity_level">Nivel de Actividad</label>
                    <div>
                        <input type="radio" id="sedentary" name="activity_level" value="sedentary" required>
                        <label for="sedentary">Sedentario</label>
                        <input type="radio" id="low_activity" name="activity_level" value="low_activity" required>
                        <label for="low_activity">Baja Actividad</label>
                        <input type="radio" id="active" name="activity_level" value="active" required>
                        <label for="active">Activo</label>
                        <input type="radio" id="very_active" name="activity_level" value="very_active" required>
                        <label for="very_active">Muy Activo</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrar</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let isFormSubmitted = false;

        document.querySelector("form").addEventListener("submit", function () {
            isFormSubmitted = true;
        });

        window.addEventListener("beforeunload", function (e) {
            if (!isFormSubmitted) {
                fetch("{{ route('delete.incomplete.account') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({})
                });
            }
        });
    });
</script>
@endsection
