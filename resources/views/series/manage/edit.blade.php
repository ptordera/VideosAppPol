@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Editar Sèrie: {{ $serie->title }}</h1>

        <x-card>
            <form action="{{ route('series.manage.update', $serie) }}" method="POST" enctype="multipart/form-data" data-qa="edit-series-form">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="form-label">Títol</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $serie->title) }}" required data-qa="input-title">
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Descripció</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required data-qa="input-description">{{ old('description', $serie->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Imatge (Opcional)</label>
                    <input type="file" name="image" id="image" class="form-control" data-qa="input-image">

                    @if($serie->image)
                        <div class="mt-2">
                            <img src="{{ $serie->image }}" alt="Imatge actual" class="img-thumbnail" style="max-height: 100px;">
                            <p class="text-muted small">Imatge actual. Puja una nova imatge per reemplaçar-la.</p>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('series.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="primary">Actualitzar Sèrie</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
