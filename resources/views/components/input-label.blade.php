@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-slate-700 mb-2 transition-colors']) }}>
    {{ $value ?? $slot }}
</label>
