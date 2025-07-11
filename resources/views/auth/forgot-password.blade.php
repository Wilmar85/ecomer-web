<x-guest-layout>
    <div class="forgot-password__info">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="forgot-password__status" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="forgot-password__form">
        @csrf

        <!-- Email Address -->
        <div class="forgot-password__field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="forgot-password__input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="forgot-password__input-error" />
        </div>

        <div class="forgot-password__actions">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
