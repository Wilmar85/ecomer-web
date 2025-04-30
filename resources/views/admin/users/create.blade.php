<x-app-layout>
    <x-slot name="header">
        <h2 class="admin-users__title">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>
    <div class="admin-users__section">
        <div class="admin-users__container">
            <div class="admin-users__card">
                <div class="admin-users__card-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="admin-users__form-group">
                            <label class="admin-users__label">Nombre</label>
                            <input type="text" name="name" class="admin-users__input" required>
                        </div>
                        <div class="admin-users__form-group">
                            <label class="admin-users__label">Email</label>
                            <input type="email" name="email" class="admin-users__input" required>
                        </div>
                        <div class="admin-users__form-group">
                            <label class="admin-users__label">Contraseña</label>
                            <input type="password" name="password" class="admin-users__input" required>
                        </div>
                        <div class="admin-users__form-group">
                            <label class="admin-users__label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="admin-users__input" required>
                        </div>
                        <button type="submit" class="admin-users__submit-btn">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
