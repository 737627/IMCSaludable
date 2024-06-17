<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - IMC Saludable</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>IMC Saludable</h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Inicio</a></li>
                <li><a href="{{ route('patients.index') }}">Pacientes</a></li>
                <li><a href="{{ route('foods.index') }}">Alimentos</a></li>
                <li><a href="{{ route('diets.index') }}">Dietas</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Bienvenido a IMC Saludable</h2>
        <p>Tu herramienta para gestionar la salud y la nutrición.</p>
    </main>
</body>
</html>
