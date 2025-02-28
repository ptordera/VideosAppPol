@extends('layouts.videos-app')

@section('content')
    <div class="container">
        <h1>Gestió de Vídeos</h1>
        <!-- Botó destacat per crear vídeo -->
        <a href="{{ route('videos.manage.create') }}" class="btn btn-create-video mb-3">Crear Vídeo</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <!-- Taula que ocupa tota l'amplada disponible -->
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th>Títol</th>
                    <th>Descripció</th>
                    <th>URL</th>
                    <th>Data de publicació</th>
                    <th>Anterior</th>
                    <th>Següent</th>
                    <th>Sèrie</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->title }}</td>
                        <td>{{ \Str::limit($video->description, 50) }}</td>
                        <td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
                        <td>{{ \Carbon\Carbon::parse($video->published_at)->format('d-m-Y') }}</td>
                        <td>{{ $video->previous }}</td>
                        <td>{{ $video->next }}</td>
                        <td>{{ $video->series_id }}</td>
                        <td>
                            <a href="{{ route('videos.manage.edit', $video->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Estàs segur que vols eliminar el vídeo {{ $video->title }}?');" style="display: inline" data-qa="video-delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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

        .alert {
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .table-responsive {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table td:last-child {
            width: 180px;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        table td a {
            color: #007bff;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .btn {
            font-size: 14px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-create-video {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
            display: inline-block;
        }

        .btn-create-video:hover {
            background-color: #218838;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .table th, .table td {
                padding: 10px;
            }

            .btn {
                font-size: 14px;
                padding: 8px 15px;
            }
        }

    </style>
