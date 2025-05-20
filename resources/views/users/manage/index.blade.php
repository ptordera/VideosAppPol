@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestió d'Usuaris</h1>
            <x-button type="success" href="{{ route('users.manage.create') }}">
                <i class="fas fa-plus-circle me-2"></i>Crear Usuari
            </x-button>
        </div>

        <!-- Formulari de cerca -->
        <form method="GET" action="{{ route('users.manage.index') }}" class="mb-4">
            <div class="d-flex w-100 mx-auto" style="max-width: 500px;">
                <input type="text" name="search" class="form-control me-2" placeholder="Cerca un usuari..." value="{{ request('search') }}">
                <x-button type="primary">
                    <i class="fas fa-search"></i>
                </x-button>
            </div>
        </form>

        @if(!isset($users) || (isset($users) && $users->isEmpty()))
            <x-empty-state message="No hi ha usuaris disponibles" icon="fa-users">
                <x-button type="primary" href="{{ route('users.manage.create') }}">Crear usuari</x-button>
            </x-empty-state>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <x-table :headers="['ID', 'Usuari', 'Email', 'Rol', 'Accions']">
                    @foreach($users as $user)
                        <x-table-row>
                            <x-table-cell label="ID">{{ $user->id }}</x-table-cell>
                            <x-table-cell label="Usuari">
                                <div class="d-flex align-items-center">
                                    @if($user->profile_photo_url)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="me-2 rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    @else
                                        <div class="me-2 rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; background-color: var(--color-primary); color: white; font-weight: bold; font-size: 16px;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="fw-medium">{{ $user->name }}</span>
                                </div>
                            </x-table-cell>
                            <x-table-cell label="Email">
                                <span class="text-muted">{{ $user->email }}</span>
                            </x-table-cell>
                            <x-table-cell label="Rol">
                                @if($user->getRoleNames()->isNotEmpty())
                                    <span class="badge bg-info text-white">
                                        {{ ucfirst($user->getRoleNames()->first()) }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white">Sense rol</span>
                                @endif
                            </x-table-cell>
                            <x-table-cell label="Accions" actions>
                                <div class="d-flex gap-2">
                                    <x-button type="primary" size="sm" href="{{ route('users.manage.edit', $user) }}">
                                        <i class="fas fa-edit"></i>
                                    </x-button>

                                    <x-button type="info" size="sm" href="{{ route('users.show', $user) }}">
                                        <i class="fas fa-eye"></i>
                                    </x-button>

                                    <form action="{{ route('users.manage.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="danger" size="sm" onclick="return confirm('Estàs segur que vols eliminar aquest usuari?')">
                                            <i class="fas fa-trash"></i>
                                        </x-button>
                                    </form>
                                </div>
                            </x-table-cell>
                        </x-table-row>
                    @endforeach
                </x-table>
            </div>

            <!-- Paginación si existe -->
            @if(isset($users) && method_exists($users, 'links'))
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
