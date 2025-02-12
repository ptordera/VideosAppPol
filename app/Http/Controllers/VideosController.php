<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    // Función para obtener todos los videos y mostrarlos
    public function index()
    {
        // Obtén todos los videos desde la base de datos
        $videos = Videos::all();

        // Devuelve la vista de la lista de videos con los datos
        return view('videos.index', compact('videos'));
    }

    // Función para obtener un video por su ID
    public function show($id)
    {
        // Busca el video por su ID
        $video = Videos::find($id);

        // Si no encuentra el video, retorna un error 404
        if (!$video) {
            return response()->json(['error' => 'Video no trobat'], 404);
        }

        return view('videos.show', compact('video'));
    }

    // Nova funció que retorna la classe del controlador
    public function testedby()
    {
        // Retorna el nombre completo de la clase del controlador
        return get_class($this);
    }
}
