@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestió de Vídeos</h1>
            <x-button type="success" href="{{ route('videos.manage.create') }}">
                <i class="fas fa-plus-circle me-2"></i>Crear Vídeo
            </x-button>
        </div>

        <!-- Formulari de cerca -->
        <form method="GET" action="{{ route('videos.manage.index') }}" class="mb-4">
            <div class="d-flex w-100 mx-auto" style="max-width: 500px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Cerca un vídeo..." value="{{ request('search') }}">
                <x-button type="primary">
                    <i class="fas fa-search"></i>
                </x-button>
            </div>
        </form>

        @if(!isset($videos) || (isset($videos) && $videos->isEmpty()))
            <x-empty-state message="No hi ha vídeos disponibles" icon="fa-video">
                <x-button type="primary" href="{{ route('videos.manage.create') }}">Crear vídeo</x-button>
            </x-empty-state>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <x-table :headers="['Vídeo', 'Detalls', 'Data de publicació', 'Sèrie', 'Accions']">
                    @foreach($videos as $video)
                        <x-table-row>
                            <x-table-cell label="Vídeo">
                                <div class="d-flex align-items-center">
                                    @php
                                        // Extraer el ID del video de la URL
                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->url, $matches);
                                        $videoId = $matches[1] ?? null; // Si no se encuentra el ID, se establece como null
                                    @endphp

                                    <div class="me-3 rounded overflow-hidden" style="width: 80px; height: 45px; flex-shrink: 0;">
                                        @if($videoId)
                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="{{ $video->title }}" class="w-100 h-100 object-cover">
                                        @else
                                            <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                                <i class="fas fa-video text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="fw-medium">{{ $video->title }}</span>
                                        <div class="mt-1">
                                            <a href="{{ $video->url }}" target="_blank" class="text-primary small">
                                                <i class="fas fa-external-link-alt me-1"></i>Veure a YouTube
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </x-table-cell>
                            <x-table-cell label="Detalls">
                                <p class="text-muted mb-0">{{ \Str::limit($video->description, 50) }}</p>
                            </x-table-cell>
                            <x-table-cell label="Data de publicació">
                                <span class="badge bg-success text-white">
                                    {{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}
                                </span>
                            </x-table-cell>
                            <x-table-cell label="Sèrie">
                                @if($video->series_id)
                                    <a href="{{ route('series.show', $video->series_id) }}" class="badge bg-info text-white text-decoration-none">
                                        {{ $video->series->title ?? $video->series_id }}
                                    </a>
                                @else
                                    <span class="badge bg-secondary text-white">Cap</span>
                                @endif
                            </x-table-cell>
                            <x-table-cell label="Accions" actions>
                                <div class="d-flex gap-2">
                                    <x-button type="primary" size="sm" href="{{ route('videos.manage.edit', $video->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </x-button>

                                    <x-button type="info" size="sm" href="{{ route('videos.show', $video->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </x-button>

                                    <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" data-qa="video-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="danger" size="sm" onclick="return confirm('Estàs segur que vols eliminar aquest vídeo?')">
                                            <i class="fas fa-trash"></i>
                                        </x-button>
                                    </form>
                                </div>
                            </x-table-cell>
                        </x-table-row>
                    @endforeach
                </x-table>
            </div>

            <!-- Paginación si existe -->
            @if(isset($videos) && method_exists($videos, 'links'))
                <div class="mt-4">
                    {{ $videos->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
