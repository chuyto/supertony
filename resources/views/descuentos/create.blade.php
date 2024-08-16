<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Descuento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @hasanyrole('administrador|gerente')
                <form method="POST" action="{{ route('descuentos.store') }}">
                    @csrf

                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nombre del descuento</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Nombre del descuento">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="percentage" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Porcentaje de descuento</label>
                            <div class="mt-2">
                                <input type="number" name="percentage" id="percentage" step="0.01" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Porcentaje del descuento">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="expiration" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Fecha de expiración</label>
                            <div class="mt-2">
                                <input type="date" name="expiration" id="expiration" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_active" value="0"> <!-- Campo oculto para manejar el estado desmarcado -->
                            <input type="checkbox" name="is_active" id="is_active" value="1" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-600">
                            <label for="is_active" class="ml-2 block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Activo</label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                                Guardar
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
