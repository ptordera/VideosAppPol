<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <x-card>
                    <h3 class="mb-4">Els Meus Vídeos</h3>

                    @if(Auth::user()->videos && Auth::user()->videos->count() > 0)
                        <div class="card-grid">
                            @foreach(Auth::user()->videos as $video)
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
                    @else
                        <x-empty-state message="No tens vídeos" icon="fa-video">
                            <x-button type="primary" href="{{ route('videos.create') }}">Crear Vídeo</x-button>
                        </x-empty-state>
                    @endif
                </x-card>
            </div>

            <div class="col-md-4">
                <x-card>
                    <h3 class="mb-4">Accions Ràpides</h3>
                    <div class="d-grid gap-3">
                        <x-button type="success" href="{{ route('videos.create') }}">
                            <i class="fas fa-plus-circle me-2"></i>Crear Vídeo
                        </x-button>

                        @if(Auth::user()->can('manage-videos'))
                            <x-button type="primary" href="{{ route('videos.manage.index') }}">
                                <i class="fas fa-cog me-2"></i>Gestionar Vídeos
                            </x-button>
                        @endif

                        @if(Auth::user()->can('manage-series'))
                            <x-button type="primary" href="{{ route('series.manage.index') }}">
                                <i class="fas fa-list me-2"></i>Gestionar Sèries
                            </x-button>
                        @endif

                        @if(Auth::user()->can('manage-users'))
                            <x-button type="primary" href="{{ route('users.manage.index') }}">
                                <i class="fas fa-users me-2"></i>Gestionar Usuaris
                            </x-button>
                        @endif

                        <x-button type="secondary" href="{{ route('profile.show') }}">
                            <i class="fas fa-user me-2"></i>El Meu Perfil
                        </x-button>
                    </div>
                </x-card>

                <x-card class="mt-4">
                    <h3 class="mb-4">Estadístiques</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Els meus vídeos
                            <span class="badge bg-primary rounded-pill">{{ Auth::user()->videos ? Auth::user()->videos->count() : 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Vídeos totals
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Videos::count() }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sèries totals
                            <span class="badge bg-primary rounded-pill">{{ \App\Models\Serie::count() }}</span>
                        </li>
                    </ul>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
