@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'modal__container--sm',
    'md' => 'modal__container--md',
    'lg' => 'modal__container--lg',
    'xl' => 'modal__container--xl',
    '2xl' => 'modal__container--2xl',
][$maxWidth];
@endphp

<div
    class="modal"
    data-modal-name="{{ $name }}"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        class="modal__overlay"
        data-modal-close
    >
        <div class="modal__overlay__bg"></div>
    </div>

    <div
        class="modal__container {{ $maxWidth }}"
    >
        {{ $slot }}
        <button type="button" data-modal-close style="display:none"></button>
    </div>
</div>
