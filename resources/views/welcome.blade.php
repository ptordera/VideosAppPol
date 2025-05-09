@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Benvingut a VideosApp</h1>
            <p class="lead text-muted">La teva plataforma per descobrir i compartir vídeos educatius</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <x-card>
                    <div class="text-center p-4">
                        <i class="fas fa-film fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h3>Explora Vídeos</h3>
                        <p>Descobreix una àmplia col·lecció de vídeos educatius sobre diferents temes.</p>
                        <x-button type="primary" href="{{ route('videos.index') }}">Veure Vídeos</x-button>
                    </div>
                </x-card>
            </div>

            <div class="col-md-4 mb-4">
                <x-card>
                    <div class="text-center p-4">
                        <i class="fas fa-list fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h3>Explora Sèries</h3>
                        <p>Accedeix a sèries completes de vídeos organitzats per temes específics.</p>
                        <x-button type="primary" href="{{ route('series.index') }}">Veure Sèries</x-button>
                    </div>
                </x-card>
            </div>

            <div class="col-md-4 mb-4">
                <x-card>
                    <div class="text-center p-4">
                        <i class="fas fa-users fa-3x mb-3" style="color: var(--color-primary);"></i>
                        <h3>Comunitat</h3>
                        <p>Connecta amb altres usuaris i descobreix els seus vídeos compartits.</p>
                        <x-button type="primary" href="{{ route('users.index') }}">Veure Usuaris</x-button>
                    </div>
                </x-card>
            </div>
        </div>

        @if (Auth::check())
            <div class="text-center mt-5">
                <x-button type="success" href="{{ route('videos.create') }}">
                    <i class="fas fa-plus-circle me-2"></i>Crear Nou Vídeo
                </x-button>
            </div>
        @else
            <div class="text-center mt-5">
                <p>Inicia sessió per començar a compartir els teus propis vídeos</p>
                <div class="d-flex justify-content-center gap-3">
                    <x-button type="primary" href="{{ route('login') }}">Iniciar Sessió</x-button>
                    <x-button type="secondary" href="{{ route('register') }}">Registrar-se</x-button>
                </div>
            </div>
        @endif
    </div>
@endsection
