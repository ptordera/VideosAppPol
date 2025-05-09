@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Eliminar Usuari: {{ $user->name }}</h1>

        <x-card>
            <div class="mb-4">
                <p>Estàs segur que vols eliminar l'usuari <strong>{{ $user->name }}</strong>?</p>
                <p class="text-danger"><strong>Aquesta acció no es pot desfer.</strong></p>
            </div>

            <form action="{{ route('users.manage.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between">
                    <x-button type="secondary" href="{{ route('users.manage.index') }}">Cancel·lar</x-button>
                    <x-button type="danger">Eliminar Usuari</x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
