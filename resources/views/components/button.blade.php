@props(['type' => 'primary', 'size' => '', 'href' => null])

@php
    $classes = 'btn btn-' . $type;
    if ($size) {
        $classes .= ' btn-' . $size;
    }
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
