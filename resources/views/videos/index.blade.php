@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Llista de Vídeos</h1>

        @if (Auth::check())
            <div class="text-center mb-5">
                <x-button type="success" href="{{ route('videos.create') }}">
                    <i class="fas fa-plus-circle me-2"></i>Crear Vídeo
                </x-button>
            </div>
        @endif

        @if($videos->isEmpty())
            <x-empty-state message="No hi ha vídeos disponibles" icon="fa-video">
                @if(Auth::check())
                    <x-button type="primary" href="{{ route('videos.create') }}">Afegir vídeo</x-button>
                @endif
            </x-empty-state>
        @else
            <div class="card-grid">
                @foreach ($videos as $video)
                    <x-card>
                        @php
                            // Extraer el ID del video de la URL
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                            $videoId = $matches[1] ?? null; // Si no se encuentra el ID, se establece como null
                        @endphp

                        <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--border-radius) var(--border-radius) 0 0;">
                            @if($videoId)
                                <iframe
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=0"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-video fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <div class="p-3">
                            <h3>{{ $video->title }}</h3>
                            <p class="text-muted">{{ \Str::limit($video->description, 60) }}</p>
                            <div class="d-flex justify-content-end">
                                <x-button type="primary" size="sm" href="{{ route('videos.show', $video->id) }}">Veure Detall</x-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <!-- Paginación si existe -->
            @if(method_exists($videos, 'links'))
                <div class="mt-4">
                    {{ $videos->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
