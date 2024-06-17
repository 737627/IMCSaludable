@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cambiar Contraseña para {{ $user->name }}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.users.update-password', $user) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
    </form>
</div>
@endsection
