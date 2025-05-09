@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="text-center mb-5 p-5 bg-light" style="border-radius: var(--border-radius);">
            <h1>{{ $serie->title }}</h1>
            <p class="text-muted">{{ $serie->description }}</p>
        </div>

        <!-- Series Details -->
        <x-card class="mb-5">
            <div class="d-flex flex-column flex-md-row">
                <div class="flex-shrink-0 mb-4 mb-md-0 me-md-4" style="max-width: 300px;">
                    <img src="{{ $serie->image ?? 'https://cdn-icons-png.flaticon.com/512/6553/6553523.png' }}" alt="Series Image" class="img-fluid rounded" style="width: 100%;">
                </div>
                <div>
                    <ul class="list-unstyled">
                        <li><strong>Publicada el:</strong> {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}</li>
                        @if($serie->user_name)
                            <li class="mt-2">
                                <strong>Creada per:</strong> {{ $serie->user_name }}
                                @if($serie->user_photo_url)
                                    <img src="{{ $serie->user_photo_url }}" alt="Usuari" class="rounded-circle ms-2" width="30" height="30" style="object-fit: cover;">
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </x-card>

        <!-- Associated Videos -->
        <h3 class="mb-4 text-center">Vídeos Associats</h3>

        @if($videos->isEmpty())
            <x-empty-state message="No hi ha vídeos associats a aquesta sèrie" icon="fa-video">
                @if(Auth::check() && Auth::user()->can('manage-videos'))
                    <x-button type="primary" href="{{ route('videos.manage.create') }}">Afegir vídeo</x-button>
                @endif
            </x-empty-state>
        @else
            <div class="card-grid">
                @foreach($videos as $video)
                    <x-card>
                        <iframe width="100%" height="180"
                                src="{{ $video->url }}?autoplay=0"
                                title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                style="pointer-events: none; border-radius: var(--border-radius) var(--border-radius) 0 0;"></iframe>

                        <div class="p-4">
                            <h3>{{ $video->title }}</h3>
                            <p class="text-muted">{{ \Str::limit($video->description, 60) }}</p>
                            <x-button type="primary" size="sm" href="{{ route('videos.show', $video) }}">Veure Detalls</x-button>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-5 text-center">
            <x-button type="secondary" href="{{ route('series.index') }}">← Tornar a les Sèries</x-button>
        </div>
    </div>
@endsection
