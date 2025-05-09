@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Crear Nova Sèrie</h1>

        <x-card>
            <form action="{{ route('series.manage.store') }}" method="POST" enctype="multipart/form-data" data-qa="create-series-form">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label">Títol</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required data-qa="input-title">
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Descripció</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required data-qa="input-description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Imatge (Opcional)</label>
                    <input type="file" name="image" id="image" class="form-control" data-qa="input-image">
                </div>

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('series.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="success">Crear Sèrie</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
