@extends('layouts.videos-app')

@section('content')
    <div class="container">
        <h1>Editar Vídeo</h1>

        <form action="{{ route('videos.manage.update', $video->id) }}" method="POST" data-qa="video-edit-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Títol</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descripció</label>
                <textarea class="form-control" id="description" name="description">{{ $video->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="url">URL</label>
                <input type="url" class="form-control" id="url" name="url" value="{{ $video->url }}" required>
            </div>

            <div class="form-group">
                <label for="published_at">Data de publicació</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ \Carbon\Carbon::parse($video->published_at)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="previous">Vídeo anterior</label>
                <input type="text" class="form-control" id="previous" name="previous" value="{{ $video->previous }}">
            </div>

            <div class="form-group">
                <label for="next">Vídeo següent</label>
                <input type="text" class="form-control" id="next" name="next" value="{{ $video->next }}">
            </div>

            <div class="form-group">
                <label for="series_id">Sèrie</label>
                <input type="number" class="form-control" id="series_id" name="series_id" value="{{ $video->series_id }}">
            </div>

            <button type="submit" class="btn btn-edit-video mt-3">Actualitzar Vídeo</button>
        </form>
    </div>
@endsection

<style>
    .container {
        margin-top: 30px;
    }

    h1 {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 16px;
        color: #333;
        margin-bottom: 10px;
        display: block;
    }

    .form-control {
        font-size: 16px;
        padding: 12px 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    textarea.form-control {
        height: 150px;
        resize: vertical;
    }

    .btn-edit-video {
        background-color: #ffc107;
        color: white;
        font-size: 16px;
        font-weight: 600;
        padding: 12px 25px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .btn-edit-video:hover {
        background-color: #e0a800;
        transform: scale(1.05);
    }

    .btn-edit-video:active {
        background-color: #c69500;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 24px;
        }

        .form-control {
            font-size: 14px;
            padding: 10px 12px;
        }

        .btn-edit-video {
            font-size: 14px;
            padding: 10px 15px;
        }
    }

</style>
