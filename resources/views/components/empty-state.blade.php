@props(['icon' => 'fa-folder-open', 'message' => 'No hi ha contingut disponible'])

<div class="empty-state">
    <i class="fas {{ $icon }}"></i>
    <h3>{{ $message }}</h3>
    {{ $slot }}
</div>
