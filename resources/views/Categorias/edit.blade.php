<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @hasanyrole('administrador|gerente')
                    <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="px-6 py-4">
                            <div class="mb-4">
                                <label for="categoria" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Categoria</label>
                                <div class="mt-2">
                                    <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $categoria->categoria) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Nombre de la categoría">
                                </div>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                                    Actualizar
                                </button>
                                <a href="{{ route('categorias.index') }}" class="ml-4 inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
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
