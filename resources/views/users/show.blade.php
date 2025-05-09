@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Detall de l'Usuari</h1>

        <x-card class="mb-5">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-4">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}'s photo" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                    @else
                        <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 80px; height: 80px; background-color: var(--color-primary); color: white; font-weight: bold; font-size: 32px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <h2>{{ $user->name }}</h2>
                    <p class="text-muted">{{ $user->email }}</p>
                    @if($user->getRoleNames()->isNotEmpty())
                        <p><strong>Rol:</strong> {{ $user->getRoleNames()->first() }}</p>
                    @endif
                </div>
            </div>
        </x-card>

        <h2 class="mb-4">Vídeos de l'Usuari</h2>

        @if($user->videos->isEmpty())
            <x-empty-state message="L'usuari no té vídeos" icon="fa-video">
                @if(Auth::check() && Auth::user()->can('manage-videos'))
                    <x-button type="primary" href="{{ route('videos.manage.create') }}">Afegir vídeo</x-button>
                @endif
            </x-empty-state>
        @else
            <div class="card-grid">
                @foreach($user->videos as $video)
                    <x-card>
                        <div class="mb-3" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: var(--border-radius) var(--border-radius) 0 0;">
                            <iframe
                                src="{{ $video->url }}"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="p-3">
                            <h3>{{ $video->title }}</h3>
                            <p class="text-muted">{{ Str::limit($video->description, 100) }}</p>
                            <p class="small text-muted"><strong>Publicat el:</strong> {{ $video->published_at }}</p>
                            <x-button type="primary" size="sm" href="{{ route('videos.show', $video->id) }}">Veure Detall</x-button>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif

        <div class="mt-5 text-center">
            <x-button type="secondary" href="{{ route('users.index') }}">← Tornar als Usuaris</x-button>
        </div>
    </div>
@endsection
