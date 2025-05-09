@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Eliminar Sèrie: {{ $serie->title }}</h1>

        <x-card>
            <div class="mb-4">
                <p>Estàs a punt d'eliminar aquesta sèrie. Si la sèrie té vídeos associats, aquests es desassignaran de manera automàtica.</p>
                <p class="text-danger"><strong>Aquesta acció no es pot desfer.</strong></p>
            </div>

            <form action="{{ route('series.manage.destroy', $serie) }}" method="POST" data-qa="delete-series-form">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('series.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="danger">Eliminar Sèrie</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
