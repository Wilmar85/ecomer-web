<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="reset-password__form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="reset-password__field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="reset-password__input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="reset-password__input-error" />
        </div>

        <!-- Password -->
        <div class="reset-password__field-separator">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="reset-password__input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="reset-password__input-error" />
        </div>

        <!-- Confirm Password -->
        <div class="reset-password__field-separator">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="reset-password__input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="reset-password__input-error" />
        </div>

        <div class="reset-password__actions">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
