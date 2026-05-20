@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 font-medium mt-2']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">✕ {{ $message }}</li>
        @endforeach
    </ul>
@endif
