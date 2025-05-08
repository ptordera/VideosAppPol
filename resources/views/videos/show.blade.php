@extends('layouts.videos-app')

@section('content')
    <div class="video-detail">
        <h1>{{ $video['title'] }}</h1>
        <p class="video-description">{{ $video['description'] }}</p>

        <div class="video-iframe">
            @php
                // Extraer el ID del video de la URL
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video['url'], $matches);
                $videoId = $matches[1] ?? null; // Si no se encuentra el ID, se establece como null
            @endphp

            @if($videoId)
                <iframe width="100%" height="500" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @else
                <p>No se pudo encontrar el video.</p>
            @endif

            <div class="video-info">
                <p>Data de publicació: {{ $video['published_at'] }}</p>
            </div>
            @if (auth()->user() && auth()->user()->id == $video['user_id'])
                <div class="video-actions">
                    <a href="{{ route('videos.edit', $video['id']) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('videos.destroy', $video['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            @endif
        </div>
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

        /* Estilo para el iframe */
        .video-iframe iframe {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
