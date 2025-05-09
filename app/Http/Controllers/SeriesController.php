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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'user_name' => 'nullable|string|max:255',
            'user_photo_url' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $request->merge([
            'user_name' => auth()->user()->name,
            'user_photo_url' => auth()->user()->profile_photo_url,
            'published_at' => now(),
        ]);

        Serie::create($request->all());

        return redirect()->route('series.index')->with('success', 'Sèrie creada correctament.');
    }

    public function create()
    {
    return view('series.create');
    }
}
