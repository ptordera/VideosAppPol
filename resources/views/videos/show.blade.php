@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">{{ $video['title'] }}</h1>

        <x-card class="mb-5">
            <div class="mb-4">
                @php
                    // Extraer el ID del video de la URL
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video['url'], $matches);
                    $videoId = $matches[1] ?? null; // Si no se encuentra el ID, se establece como null
                @endphp

                <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--border-radius);">
                    @if($videoId)
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-video fa-3x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <h3>Descripció</h3>
                <p>{{ $video['description'] }}</p>
            </div>

            <div class="mb-4">
                <p><strong>Data de publicació:</strong> {{ $video['published_at'] }}</p>

                @if(isset($video['series_id']) && $video['series_id'])
                    <p><strong>Sèrie:</strong>
                        <a href="{{ route('series.show', $video['series_id']) }}">
                            {{ $video['series_title'] ?? 'Veure sèrie' }}
                        </a>
                    </p>
                @endif
            </div>

            @if (auth()->user() && auth()->user()->id == $video['user_id'])
                <div class="d-flex gap-2">
                    <x-button type="primary" href="{{ route('videos.edit', $video['id']) }}">
                        <i class="fas fa-edit me-2"></i>Editar
                    </x-button>

                    <form action="{{ route('videos.destroy', $video['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button type="danger" onclick="return confirm('Estàs segur que vols eliminar aquest vídeo?')">
                            <i class="fas fa-trash me-2"></i>Eliminar
                        </x-button>
                    </form>
                </div>
            @endif
        </x-card>

        <div class="d-flex justify-content-between mt-5">
            @if(isset($video['previous']) && $video['previous'])
                <x-button type="secondary" href="{{ route('videos.show', $video['previous']) }}">
                    <i class="fas fa-arrow-left me-2"></i>Vídeo anterior
                </x-button>
            @else
                <div></div>
            @endif

            <x-button type="secondary" href="{{ route('videos.index') }}">
                <i class="fas fa-list me-2"></i>Tornar a la llista
            </x-button>

            @if(isset($video['next']) && $video['next'])
                <x-button type="secondary" href="{{ route('videos.show', $video['next']) }}">
                    Vídeo següent<i class="fas fa-arrow-right ms-2"></i>
                </x-button>
            @else
                <div></div>
            @endif
        </div>
    </div>
@endsection
