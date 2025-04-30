<x-app-layout>
    <x-slot name="header">
        <h2 class="bem-base__title">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="bem-base__py">
        <div class="bem-base__container">
            <!-- Botón Ver Pedidos -->
            <div class="bem-base__actions">
                <a href="{{ route('orders.index') }}" 
                   class="primary-btn">
                    {{ __('Ver Pedidos') }}
                </a>
            </div>

            <div class="bem-base__card">
                <div class="bem-base__card-inner">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bem-base__card">
                <div class="bem-base__card-inner">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bem-base__card">
                <div class="bem-base__card-inner">
                    @include('profile.partials.orders-history')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
