@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Editar Usuari: {{ $user->name }}</h1>

        <x-card>
            <form action="{{ route('users.manage.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('users.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="primary">Actualitzar Usuari</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
