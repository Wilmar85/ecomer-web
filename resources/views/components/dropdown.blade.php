@props([
    'align' => 'right',
    'width' => '48',
    'contentClasses' => 'py-1 bg-white'
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
        'top' => 'origin-top',
        default => 'ltr:origin-top-right rtl:origin-top-left end-0',
    };

    $widthClass = $width === '48' ? 'dropdown--width-48' : $width;
@endphp

<div class="dropdown">
    <!-- Botón para mobile -->
    <button type="button" class="dropdown__mobile-toggle sm:hidden" aria-label="Abrir/Cerrar menú">
        <svg width="42" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>

    <div class="dropdown__trigger">
        {{ $trigger }}
    </div>

    <div class="dropdown__content {{ $alignmentClasses }} {{ $widthClass }} {{ $contentClasses }}" style="display: none;">
        <div class="dropdown__item">
            {{ $content }}
        </div>
    </div>
</div>