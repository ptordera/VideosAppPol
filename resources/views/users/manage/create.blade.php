@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Crear Usuari</h1>

        <x-card>
            <form action="{{ route('users.manage.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required data-qa="input-name">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required data-qa="input-email">
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-control" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Contrasenya</label>
                    <input type="password" name="password" id="password" class="form-control" required data-qa="input-password">
                </div>

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('users.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="success">Crear Usuari</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
