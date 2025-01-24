@extends('layouts.videos-app')

@section('content')
    <div class="video-detail">
        <h1>{{ $video['title'] }}</h1>
        <p class="video-description">{{ $video['description'] }}</p>
        <a href="{{ $video['url'] }}" class="video-link" target="_blank">Mira el vídeo</a>
    </div>
@endsection

@push('styles')
    <style>
        /* Estilo para el contenedor de detalles del video */
        .video-detail {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para el título */
        .video-detail h1 {
            font-size: 2.5em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilo para la descripción del video */
        .video-description {
            font-size: 1.2em;
            color: #555;
            line-height: 1.6;
            margin-bottom: 20px;
            text-align: justify;
        }

        /* Estilo para el enlace del video */
        .video-link {
            display: inline-block;
            font-size: 1.2em;
            color: #fff;
            background-color: #3498db;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        /* Efecto hover para el enlace */
        .video-link:hover {
            background-color: #2980b9;
        }
    </style>
@endpush
