@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Eliminar Vídeo: {{ $video->title }}</h1>

        <x-card>
            <div class="mb-4">
                <p>Estàs segur que vols eliminar el vídeo <strong>{{ $video->title }}</strong>?</p>
                <p class="text-danger"><strong>Aquesta acció no es pot desfer.</strong></p>
            </div>

            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" data-qa="video-delete-form">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('videos.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="danger">Eliminar Vídeo</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
