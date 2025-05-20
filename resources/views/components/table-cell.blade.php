@props(['label' => ''])

<td data-label="{{ $label }}" {{ $attributes->class(['actions-cell' => $attributes->has('actions')]) }}>
    {{ $slot }}
</td>
