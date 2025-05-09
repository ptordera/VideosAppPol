@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Crear Vídeo</h1>

        <x-card>
            <form action="{{ route('videos.store') }}" method="POST" data-qa="video-create-form">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label">Títol</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Descripció</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" name="url" id="url" class="form-control" value="{{ old('url') }}" required>
                    <small class="text-muted">Introdueix una URL de YouTube (ex: https://www.youtube.com/watch?v=XXXX)</small>
                </div>

                <div class="mb-4">
                    <label for="published_at" class="form-label">Data de publicació</label>
                    <input type="date" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') ?? date('Y-m-d') }}" required>
                </div>

                <div class="mb-4">
                    <label for="previous" class="form-label">Vídeo anterior (opcional)</label>
                    <input type="text" name="previous" id="previous" class="form-control" value="{{ old('previous') }}">
                </div>

                <div class="mb-4">
                    <label for="next" class="form-label">Vídeo següent (opcional)</label>
                    <input type="text" name="next" id="next" class="form-control" value="{{ old('next') }}">
                </div>

                <div class="mb-4">
                    <label for="series_id" class="form-label">Sèrie (opcional)</label>
                    <select name="series_id" id="series_id" class="form-control">
                        <option value="">Selecciona una sèrie</option>
                        @foreach ($series as $serie)
                            <option value="{{ $serie->id }}" {{ old('series_id') == $serie->id ? 'selected' : '' }}>
                                {{ $serie->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('videos.index') }}">Cancel·lar</x-button>
                    <x-button type="success">Crear Vídeo</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
