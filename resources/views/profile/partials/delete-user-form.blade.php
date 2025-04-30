<section class="bem-base__section">
    <header>
        <h2 class="bem-base__title">
            {{ __('Delete Account') }}
        </h2>

        <p class="input-error">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        data-delete-user-btn
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="bem-base__card-body">
            @csrf
            @method('delete')

            <h2 class="bem-base__title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="input-error">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="bem-base__mt">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="delete-user__input"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="input-error" />
            </div>

            <div class="bem-base__actions">
                <x-secondary-button data-close-modal-btn class="delete-user__secondary-btn">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="delete-user__danger-btn">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
