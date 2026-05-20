@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 font-medium flex items-center gap-2']) }}>
        <span>✓</span>
        {{ $status }}
    </div>
@endif
