<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IMCSaludable')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 1em;
            text-align: center;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <header>
        <h1>IMCSaludable</h1>
        <nav>
            <ul>
                @if(Auth::check())
                    <li>Sesión: {{ Auth::user()->name }} ({{ Auth::user()->role ?? 'Usuario' }})</li>
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}">Administración</a></li>
                    @else
                        <li><a href="{{ route('patient.dashboard') }}">Dashboard</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @endif
                <li><a href="{{ route('foods.index') }}">Alimentos</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
