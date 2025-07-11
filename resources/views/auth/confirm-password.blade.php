<x-guest-layout>
    <div class="confirm-password__info">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="confirm-password__form">
        @csrf

        <!-- Password -->
        <div class="confirm-password__field">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="confirm-password__input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="confirm-password__actions">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
