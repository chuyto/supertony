<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="form-input mt-1 block w-full" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="form-input mt-1 block w-full" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" id="password" name="password" class="form-input mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="roles" class="block text-gray-700">Roles</label>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" id="roles[]" name="roles[]" value="{{ $role->id }}" class="form-check-input" {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
                                    <label for="roles[]" class="form-check-label">{{ $role->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
