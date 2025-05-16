<x-app-layout>
  {{--   <x-slot name="header">
        <h2 class="dashboard__title">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="dashboard__section">
        <div class="dashboard__container">
            <div class="dashboard__card">
                <div class="dashboard__card-body">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
