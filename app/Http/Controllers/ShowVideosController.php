<?php

namespace App\Http\Controllers;

use App\Models\Videos;

use Illuminate\Http\Request;

class ShowVideosController extends Controller
{
    public function index()
    {
        $videos = Videos::all();
        return view('videos.index', compact('videos'));
    }
}
