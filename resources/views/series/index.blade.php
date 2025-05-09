@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Título principal -->
        <div class="text-center mb-5">
            <h1>Explora les Millors Sèries</h1>
            <p class="text-muted">Descobreix, cerca i gaudeix de les teves sèries preferides en un sol lloc.</p>
        </div>

        <!-- Formulari de cerca -->
        <div class="mb-5">
            <form action="{{ route('series.index') }}" method="GET" class="d-flex justify-content-center">
                <div class="d-flex w-100" style="max-width: 500px;">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cerca una sèrie..." value="{{ request('search') }}">
                    <x-button type="primary">Buscar</x-button>
                </div>
            </form>
        </div>

        <!-- Botón para crear serie -->
        @if(Auth::check() && Auth::user())
            <div class="mb-4 text-center">
                <x-button type="primary" href="{{ route('series.create') }}">Crear sèrie</x-button>
            </div>
        @endif

        <!-- Llistat de sèries -->
        @if($series->isEmpty())
            <x-empty-state message="No hi ha sèries disponibles" icon="fa-film">
                @if(Auth::check() && Auth::user()->can('manage-series'))
                    <x-button type="primary" href="{{ route('series.manage.create') }}">Crear sèrie</x-button>
                @endif
            </x-empty-state>
        @else
            <div class="card-grid">
                @foreach ($series as $serie)
                    <x-card>
                        <!-- Imatge destacada -->
                        <div style="height: 200px; background: url('{{ $serie->image ?? 'https://cdn-icons-png.flaticon.com/512/6553/6553523.png' }}') center/cover; border-radius: var(--border-radius) var(--border-radius) 0 0;"></div>

                        <div class="p-4">
                            <h3>{{ $serie->title }}</h3>
                            <p class="text-muted">{{ \Str::limit($serie->description, 80) }}</p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-muted">{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicada' }}</small>
                                <x-button type="primary" size="sm" href="{{ route('series.show', $serie->id) }}">Veure més</x-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <!-- Paginación si existe -->
            @if(method_exists($series, 'links'))
                <div class="mt-4">
                    {{ $series->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
