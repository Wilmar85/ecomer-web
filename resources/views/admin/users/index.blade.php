<x-app-layout>
    <x-slot name="header">
        <div class="admin-users__header">
            <h2 class="admin-users__title">
                {{ __('Gestión de Usuarios') }}
            </h2>
            <a href="{{ route('admin.users.create') }}"
               class="admin-users__create-btn">
                Crear Usuario
            </a>
        </div>
    </x-slot>
    <div class="admin-users__section">
        <div class="admin-users__container">
            <div class="admin-users__card">
                <div class="admin-users__card-body">
                    @if (session('success'))
                        <div class="admin-users__alert" role="alert">
                            <span class="admin-users__alert-text">{{ session('success') }}</span>
                        </div>
                    @endif
                    <div class="admin-users__table-wrapper">
                        <table class="admin-users__table">
                            <thead class="admin-users__thead">
                                <tr>
                                    <th class="admin-users__th">Nombre</th>
                                    <th class="admin-users__th">Email</th>
                                    <th class="admin-users__th">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="admin-users__tbody">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="admin-users__td">{{ $user->name }}</td>
                                        <td class="admin-users__td">{{ $user->email }}</td>
                                        <td class="admin-users__td">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="admin-users__edit-link">Editar</a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="admin-users__delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="admin-users__delete-btn" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
