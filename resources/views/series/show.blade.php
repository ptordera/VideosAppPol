@extends('layouts.videos-app')

@section('content')
    <div class="container py-5">
        <!-- Hero Section -->
        <div class="hero text-center mb-5">
            <h1 class="display-4">{{ $serie->title }}</h1>
            <p class="lead text-muted">{{ $serie->description }}</p>
        </div>

        <!-- Series Details -->
        <div class="details-card mb-5 p-4 shadow-lg rounded bg-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ $serie->image ?? 'https://cdn-icons-png.flaticon.com/512/6553/6553523.png' }}" alt="Series Image" class="img-fluid rounded shadow-sm">
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li><strong>Publicada el:</strong> {{ $serie->published_at ? \Carbon\Carbon::parse($serie->published_at)->format('d/m/Y') : 'No especificada' }}</li>
                        @if($serie->user_name)
                            <li class="mt-2">
                                <strong>Creada per:</strong> {{ $serie->user_name }}
                                @if($serie->user_photo_url)
                                    <img src="{{ $serie->user_photo_url }}" alt="Usuari" class="rounded-circle ms-2" width="30" height="30" style="object-fit: cover;">
                                @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Associated Videos -->
        <h3 class="mb-4 text-center text-dark">Vídeos Associats</h3>
        @if($videos->isEmpty())
            <p class="text-muted text-center">No hi ha vídeos associats a aquesta sèrie.</p>
        @else
            <div class="row g-4">
                @foreach($videos as $video)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm rounded-lg">
                            <iframe class="card-img-top rounded-top" width="100%" height="180"
                                    src="{{ $video->url }}?autoplay=0"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                    style="pointer-events: none;"></iframe>
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{ $video->title }}</h5>
                                <p class="card-text text-truncate text-muted">{{ \Str::limit($video->description, 60) }}</p>
                                <a href="{{ route('videos.show', $video) }}" class="btn btn-outline-primary btn-sm">Veure Detalls</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-5 text-center">
            <a href="{{ route('series.index') }}" class="btn btn-secondary">← Tornar a les Sèries</a>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Hero Section */
        .hero {
            background-color: #fafafa;
            padding: 50px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .hero p {
            font-size: 1.1rem;
            color: #666;
        }

        /* Card Details */
        .details-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .details-card img {
            max-height: 280px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Video Cards */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-radius: 12px 12px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 0.9rem;
            color: #777;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Back Button */
        .btn-secondary {
            font-weight: 600;
            padding: 8px 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .hero {
                padding: 40px 20px;
            }

            .card-body {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .card-title {
                font-size: 1rem;
            }

            .card-text {
                font-size: 0.875rem;
            }
        }
    </style>
@endpush
