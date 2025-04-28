<button {{ $attributes->merge(['type' => 'button', 'class' => 'secondary-btn']) }}>
    {{ $slot }}
</button>
