<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Descuento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @hasanyrole('administrador|gerente')
                <form method="POST" action="{{ route('descuentos.update', $descuento->id) }}">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-md">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nombre del Descuento</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name', $descuento->name) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Nombre del descuento">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="percentage" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Porcentaje</label>
                            <div class="mt-2">
                                <input type="text" name="percentage" id="percentage" value="{{ old('percentage', $descuento->percentage) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Porcentaje">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="expiration" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Fecha de Expiración</label>
                            <div class="mt-2">
                                <input type="date" name="expiration" id="expiration" value="{{ old('expiration', \Carbon\Carbon::parse($descuento->expiration)->format('Y-m-d')) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Fecha de expiración">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $descuento->is_active) ? 'checked' : '' }} value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-900 dark:text-gray-200">Activo</span>
                            </label>
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                                Actualizar
                            </button>
                            <a href="{{ route('descuentos.index') }}" class="ml-4 inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
                @else
                <script>
                    window.location.href = "{{ route('pos.index') }}";
                </script>
                @endhasanyrole
            </div>
        </div>
    </div>
</x-app-layout>
