<?php

namespace App\View\Components;

use Illuminate\View\Component;

class VideosAppLayout extends Component
{
    public function __construct()
    {
        // Si quieres pasar parámetros al layout, los puedes inicializar aquí
    }

    public function render()
    {
        return view('layouts.videos-app'); // Ruta del archivo de vista Blade
    }
}
