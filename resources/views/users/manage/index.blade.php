@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestió d'Usuaris</h1>
            <x-button type="success" href="{{ route('users.manage.create') }}">
                <i class="fas fa-plus-circle me-2"></i>Crear Usuari
            </x-button>
        </div>

        @if($users->isEmpty())
            <x-empty-state message="No hi ha usuaris disponibles" icon="fa-users">
                <x-button type="primary" href="{{ route('users.manage.create') }}">Crear usuari</x-button>
            </x-empty-state>
        @else
            <x-table :headers="['ID', 'Nom', 'Email', 'Rol', 'Accions']">
                @foreach($users as $user)
                    <x-table-row>
                        <x-table-cell label="ID">{{ $user->id }}</x-table-cell>
                        <x-table-cell label="Nom">{{ $user->name }}</x-table-cell>
                        <x-table-cell label="Email">{{ $user->email }}</x-table-cell>
                        <x-table-cell label="Rol">{{ $user->getRoleNames()->first() }}</x-table-cell>
                        <x-table-cell label="Accions">
                            <div class="d-flex gap-2">
                                <x-button type="primary" size="sm" href="{{ route('users.manage.edit', $user) }}">
                                    <i class="fas fa-edit"></i>
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

            <!-- Paginación si existe -->
            @if(method_exists($users, 'links'))
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
