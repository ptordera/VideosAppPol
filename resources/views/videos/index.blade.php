@extends('layouts.videos-app')

@section('content')
    <div class="video-list">
        <h1>Lista de Vídeos</h1>
        <ul>
            @foreach ($videos as $video)
                <li class="video-item">
                    <a href="{{ url('/videos/' . $video->id) }}" class="video-link">
                        {{ $video->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@push('styles')
    <style>
        /* Estilo para el contenedor de la lista de videos */
        .video-list {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        /* Estilo del título */
        .video-list h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Estilo para los elementos de la lista */
        .video-item {
            list-style: none;
            margin: 10px 0;
        }

        /* Estilo para los enlaces de cada video */
        .video-link {
            font-size: 1.2em;
            color: #3498db;
            text-decoration: none;
            display: block;
            padding: 10px;
            background-color: #f4f4f9;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Efecto hover */
        .video-link:hover {
            background-color: #2980b9;
            color: white;
        }
    </style>
@endpush
