@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Llista d'Usuaris</h1>

        <!-- Formulari de cerca -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-5">
            <div class="d-flex w-100 mx-auto" style="max-width: 500px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Cerca un usuari..." value="{{ request('search') }}">
                <x-button type="primary">
                    <i class="fas fa-search"></i>
                </x-button>
            </div>
        </form>

        <!-- Llistat d'usuaris -->
        @if($users->isEmpty())
            <x-empty-state message="No hi ha usuaris disponibles" icon="fa-users">
                @if(Auth::check() && Auth::user()->can('manage-users'))
                    <x-button type="primary" href="{{ route('users.manage.create') }}">Crear usuari</x-button>
                @endif
            </x-empty-state>
        @else
            <div class="card-grid">
                @foreach($users as $user)
                    <x-card>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                @if($user->profile_photo_url)
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}'s photo" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; background-color: var(--color-primary); color: white; font-weight: bold; font-size: 24px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3>{{ $user->name }}</h3>
                                <p class="text-muted">{{ $user->email }}</p>
                                <x-button type="primary" size="sm" href="{{ route('users.show', $user->id) }}">Veure Detall</x-button>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
