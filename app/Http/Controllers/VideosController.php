<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Videos;
use App\Events\VideoCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class VideosController extends Controller
{
    // Función para obtener todos los videos y mostrarlos
//    public function index()
//    {
//        // Obtén todos los videos desde la base de datos
//        $videos = Videos::all();
//
//        // Devuelve la vista de la lista de videos con los datos
//        return view('videos.index', compact('videos'));
//    }
//
//    // Función para obtener un video por su ID
//    public function show($id)
//    {
//        // Busca el video por su ID
//        $video = Videos::find($id);
//
//        // Si no encuentra el video, retorna un error 404
//        if (!$video) {
//            return response()->json(['error' => 'Video no trobat'], 404);
//        }
//
//        return view('videos.show', compact('video'));
//    }
//
//    public function manage()
//    {
//        if (auth()->user()->can('manage-videos')) {
//
//            return view('videos.manage');
//        }
//        abort(403, 'No tens permisos per gestionar vídeos');
//    }
//
//    // Nova funció que retorna la classe del controlador
//    public function testedby()
//    {
//        // Retorna el nombre completo de la clase del controlador
//        return get_class($this);
//    }

    public function index()
    {
        $videos = Videos::all();

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        $series = Serie::all();
        return view('videos.create', compact('series'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exists:series,id',
        ]);

        $video = Videos::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'published_at' => $validated['published_at'],
            'previous' => $validated['previous'],
            'next' => $validated['next'],
            'series_id' => $validated['series_id'],
            'user_id' => auth()->id(),
        ]);

        Event::dispatch(new VideoCreated($video));

        return redirect()->route('videos.index');
    }

    public function edit($id)
    {
        $video = Videos::find($id);
        $series = Serie::all();

        if(!$video){
            return response()->json([
                'message' => 'Video not found'
            ], 404);
        }

        return view('videos.edit', compact('video', 'series'));
    }

    public function update(Request $request, $id)
    {
        $video = Videos::find($id);

        if(!$video){
            return response()->json([
                'message' => 'Video not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exists:series,id',
        ]);

        $video->update($validated);

        return redirect()->route('videos.index');
    }

    public function destroy($id)
    {
        $video = Videos::find($id);

        if(!$video){
            return response()->json([
                'message' => 'Video not found'
            ], 404);
        }

        $video->delete();

        return redirect()->route('videos.index');
    }

    public function show(string $id)
    {

        $video = Videos::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no trobat'], 404);
        }

        return view('videos.show', compact('video'));
    }
}
