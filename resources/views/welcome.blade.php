<!doctype html>
<html lang="UTF-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Pàgina Principal</title>

    <!-- Agregar estilo CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        x-videos-app {
            display: block;
            padding: 20px;
            margin: 0 auto;
            max-width: 1200px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        x-slot:title {
            font-size: 2em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.6;
            text-align: center;
        }
    </style>

</head>
<body>
<x-videos-app>
    <x-slot:title>
        Pàgina Principal
    </x-slot:title>

    <p>Benvingut a la pàgina principal de la meva aplicació de vídeos.</p>
</x-videos-app>
</body>
</html>
