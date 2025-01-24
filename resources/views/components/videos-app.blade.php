<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>

    <!-- Enlazar a la hoja de estilos CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Estilos para el encabezado */
        header {
            background-color: #3498db;
            padding: 15px 0;
            color: white;
        }

        header nav ul {
            list-style-type: none;
            text-align: center;
            padding: 0;
            margin: 0;
        }

        header nav ul li {
            display: inline;
            margin: 0 15px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }

        header nav ul li a:hover {
            background-color: #2980b9;
            border-radius: 5px;
        }

        /* Estilos para el área principal */
        main {
            padding: 30px 15px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Estilos para el pie de página */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: 30px;
        }

        footer p {
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Inici</a></li>
            <li><a href="{{ route('videos.index') }}">Vídeos</a></li>
        </ul>
    </nav>
</header>

<main>
    {{ $slot }} <!-- Aquí se renderizará el contenido del slot pasado al componente -->
</main>

<footer>
    <p>&copy; 2025 VideosApp. Tots els drets reservats. Pol Tordera Gil.</p>
</footer>

</body>
</html>
