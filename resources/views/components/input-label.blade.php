@props(['value'])

<label {{ $attributes->merge(['class' => 'form-label']) }} style="font-size: 18px; font-weight: 600; color: #000000;">
    {{ $value ?? $slot }}
</label>