@extends('layouts.videos-app')

@section('content')
    <div class="container py-5">
        <!-- Título principal -->
        <div class="text-center mb-5">
            <h1 class="display-4">Explora les Millors Sèries</h1>
            <p class="lead text-muted">Descobreix, cerca i gaudeix de les teves sèries preferides en un sol lloc.</p>
        </div>

        <!-- Formulari de cerca -->
        <div class="search-bar mb-5">
            <form action="{{ route('series.index') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control w-50 me-2" placeholder="Cerca una sèrie...">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>

        <!-- Llistat de sèries -->
        <div class="row g-4">
            @foreach ($series as $serie)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <!-- Imatge destacada -->
                        <div class="card-img-top" style="height: 200px; background: url('{{ $serie->image ?? 'https://cdn-icons-png.flaticon.com/512/6553/6553523.png' }}') center/cover;"></div>

                        <!-- Contingut de la targeta -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $serie->title }}</h5>
                            <p class="card-text text-muted">{{ \Str::limit($serie->description, 80) }}</p>
                        </div>

                        <!-- Peu de la targeta -->
                        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No publicada' }}</small>
                            <a href="{{ route('series.show', $serie->id) }}" class="btn btn-sm btn-outline-primary">Veure més</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .container {
            max-width: 1200px;
        }

        .card {
            width: 300px;
            height: 400px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            border-radius: 20px;
            padding: 10px 20px;
        }

        .search-bar button {
            border-radius: 20px;
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;

        /*    que la imagen que tiene de backgroun el div este dentro y no salga*/
            overflow: hidden;
            position: relative;


        }

        .card-footer {
            font-size: 14px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
@endpush
