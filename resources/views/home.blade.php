<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMCSaludable - Página de Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 1em;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
        }
        nav ul li a:hover {
            background-color: #0056b3;
        }
        .hero {
            text-align: center;
            padding: 100px 20px;
        }
        .hero h1 {
            font-size: 3em;
            margin: 0;
        }
        .hero p {
            font-size: 1.2em;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 2em;
        }
        .feature {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            width: 30%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .feature img {
            max-width: 100px;
        }
        .feature h2 {
            font-size: 1.5em;
            margin: 10px 0;
        }
        .feature p {
            font-size: 1em;
            color: #666;
        }
        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 1em 0;
            margin-top: 2em;
        }
    </style>
</head>
<body>
    <header>
        <h1>IMCSaludable</h1>
        <nav>
            <ul>
                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                <li><a href="{{ route('register') }}">Registrarse</a></li>
                <li><a href="{{ route('foods.index') }}">Alimentos</a></li>
            </ul>
        </nav>
    </header>
    <div class="hero">
        <h1>Bienvenido a IMCSaludable</h1>
        <p>Tu herramienta para gestionar la salud y la nutrición.</p>
    </div>
    <div class="container">
        <div class="features">
            <div class="feature">
                <img src="{{ asset('images/pacientes.png') }}" alt="Pacientes">
                <h2>Gestión de Pacientes</h2>
                <p>Administra y lleva un seguimiento detallado de tus pacientes.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/alimentos.png') }}" alt="Alimentos">
                <h2>Control de Alimentos</h2>
                <p>Registra y consulta información nutricional de diversos alimentos.</p>
            </div>
            <div class="feature">
                <img src="{{ asset('images/dietas.png') }}" alt="Dietas">
                <h2>Planificación de Dietas</h2>
                <p>Diseña dietas personalizadas para tus pacientes.</p>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 IMCSaludable. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
