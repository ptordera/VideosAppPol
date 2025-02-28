@extends('layouts.videos-app')

@section('content')
    <div class="container">
        <h1>Confirmar Eliminació</h1>

        <p>Estàs segur que vols eliminar el vídeo: <strong>{{ $video->title }}</strong>?</p>

        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar el vídeo: {{ $video->title }}');" style="display: inline" data-qa="video-delete-form">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{ route('videos.manage.index') }}" class="btn btn-secondary">Cancel·lar</a>
        </form>
    </div>
@endsection

<style>
    .container {
        margin-top: 30px;
        text-align: center;
    }

    h1 {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }

    p {
        font-size: 18px;
        color: #333;
        margin-bottom: 30px;
    }

    strong {
        font-weight: 700;
        color: #e74c3c; /* Color rojo para resaltar el título */
    }

    form {
        display: inline-block;
    }

    .btn {
        font-size: 16px;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 5px;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
        border: none;
        cursor: pointer;
        margin-right: 15px;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }

        .btn {
            font-size: 14px;
            padding: 10px 15px;
        }
    }

</style>
