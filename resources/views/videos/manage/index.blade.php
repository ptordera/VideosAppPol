@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestió de Vídeos</h1>
            <x-button type="success" href="{{ route('videos.manage.create') }}">
                <i class="fas fa-plus-circle me-2"></i>Crear Vídeo
            </x-button>
        </div>

        @if($videos->isEmpty())
            <x-empty-state message="No hi ha vídeos disponibles" icon="fa-video">
                <x-button type="primary" href="{{ route('videos.manage.create') }}">Crear vídeo</x-button>
            </x-empty-state>
        @else
            <x-table :headers="['Títol', 'Descripció', 'URL', 'Data de publicació', 'Sèrie', 'Accions']">
                @foreach($videos as $video)
                    <x-table-row>
                        <x-table-cell label="Títol">{{ $video->title }}</x-table-cell>
                        <x-table-cell label="Descripció">{{ \Str::limit($video->description, 50) }}</x-table-cell>
                        <x-table-cell label="URL">
                            <a href="{{ $video->url }}" target="_blank" class="text-primary">
                                <i class="fas fa-external-link-alt me-1"></i>Veure
                            </a>
                        </x-table-cell>
                        <x-table-cell label="Data de publicació">{{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</x-table-cell>
                        <x-table-cell label="Sèrie">
                            @if($video->series_id)
                                {{ $video->series->title ?? $video->series_id }}
                            @else
                                <span class="text-muted">Cap</span>
                            @endif
                        </x-table-cell>
                        <x-table-cell label="Accions">
                            <div class="d-flex gap-2">
                                <x-button type="primary" size="sm" href="{{ route('videos.manage.edit', $video->id) }}">
                                    <i class="fas fa-edit"></i>
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

            <!-- Paginación si existe -->
            @if(method_exists($videos, 'links'))
                <div class="mt-4">
                    {{ $videos->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
