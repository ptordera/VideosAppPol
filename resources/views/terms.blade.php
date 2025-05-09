<x-guest-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card>
                    <div class="text-center mb-4">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto">
                        </a>
                        <h1 class="mt-4">Termes i Condicions</h1>
                    </div>

                    <div class="prose">
                        {!! $terms !!}
                    </div>

                    <div class="text-center mt-4">
                        <x-button type="secondary" href="{{ route('dashboard') }}">Tornar a l'inici</x-button>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-guest-layout>
