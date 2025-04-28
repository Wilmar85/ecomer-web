@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'auth-session-status']) }}>
        {{ $status }}
    </div>
@endif
