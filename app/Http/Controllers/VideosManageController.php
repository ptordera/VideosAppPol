<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }

        $videos = Videos::all();

        return view('videos.manage.index', compact('videos'));
    }

    public function create()
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }
        return view('videos.manage.create');

    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exist:series,id',
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

        return redirect()->route('videos.manage.index')->with('success', 'Video creat correctament');

    }

    public function edit(string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }

        $video = Videos::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no trobat'], 404);
        }

        return view('videos.manage.edit', compact('video'));
    }

    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }

        $video = Videos::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no trobat'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|string|url',
            'published_at' => 'required|date',
            'previous' => 'nullable|string',
            'next' => 'nullable|string',
            'series_id' => 'nullable|integer|exist:series,id',
        ]);

        $video->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'url' => $validated['url'],
            'published_at' => $validated['published_at'],
            'previous' => $validated['previous'],
            'next' => $validated['next'],
            'series_id' => $validated['series_id'],
        ]);

        return redirect()->route('videos.manage.index')->with('success', 'Video actualitzat correctament');

    }

    public function destroy(string $id)
    {
        if (!auth()->user()->can('manage-videos')) {
            abort(403, 'No tens permisos per gestionar vídeos');
        }

        $video = Videos::find($id);

        if (!$video) {
            return response()->json(['message' => 'Video no trobat'], 404);
        }

        $video->delete();

        return redirect()->route('videos.manage.index')->with('success', 'Video eliminat correctament');
    }

    public function testedBy()
    {
        return VideosManageControllerTest::Class;
    }


}
