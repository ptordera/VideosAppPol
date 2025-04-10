<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Serie::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $series = $query->paginate(12);

        return view('series.index', compact('series'));
    }


    public function show($id)
    {

        $serie = Serie::findOrFail($id);
        $videos = $serie->videos;

        return view('series.show', compact('serie', 'videos'));
    }
}
