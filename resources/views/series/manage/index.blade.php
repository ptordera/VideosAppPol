@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestió de Sèries</h1>
            <x-button type="success" href="{{ route('series.manage.create') }}" data-qa="create-series">
                <i class="fas fa-plus-circle me-2"></i>Crear Sèrie
            </x-button>
        </div>

        @if($series->isEmpty())
            <x-empty-state message="No hi ha sèries disponibles" icon="fa-film">
                <x-button type="primary" href="{{ route('series.manage.create') }}">Crear sèrie</x-button>
            </x-empty-state>
        @else
            <x-table :headers="['ID', 'Títol', 'Descripció', 'Data de Publicació', 'Accions']">
                @foreach($series as $serie)
                    <x-table-row>
                        <x-table-cell label="ID">{{ $serie->id }}</x-table-cell>
                        <x-table-cell label="Títol">{{ $serie->title }}</x-table-cell>
                        <x-table-cell label="Descripció">{{ \Str::limit($serie->description, 50) }}</x-table-cell>
                        <x-table-cell label="Data de Publicació">{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d-m-Y') : 'No publicat' }}</x-table-cell>
                        <x-table-cell label="Accions">
                            <div class="d-flex gap-2">
                                <x-button type="primary" size="sm" href="{{ route('series.manage.edit', $serie) }}" data-qa="edit-series-{{ $serie->id }}">
                                    <i class="fas fa-edit"></i>
                                </x-button>

                                <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" data-qa="delete-series-{{ $serie->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="danger" size="sm" onclick="return confirm('Estàs segur que vols eliminar aquesta sèrie? Els vídeos associats també seran desassignats.')">
                                        <i class="fas fa-trash"></i>
                                    </x-button>
                                </form>
                            </div>
                        </x-table-cell>
                    </x-table-row>
                @endforeach
            </x-table>

            <!-- Paginación si existe -->
            @if(method_exists($series, 'links'))
                <div class="mt-4">
                    {{ $series->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
