<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('productos.update', $producto->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="px-6 py-4">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Nombre de producto</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name', $producto->name) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Nombre del producto">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Añadir descripción</label>
                            <div class="mt-2">
                                <textarea rows="4" name="description" id="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Añadir descripción">{{ old('description', $producto->description) }}</textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label for="category" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Categoria</label>
                                <div class="mt-2">
                                    <select name="category_id" id="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ $categoria->id == old('category_id', $producto->category_id) ? 'selected' : '' }}>
                                                {{ $categoria->categoria }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Precio</label>
                                <div class="mt-2">
                                    <input type="text" name="price" id="price" value="{{ old('price', $producto->price) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Precio">
                                </div>
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Existencia</label>
                                <div class="mt-2">
                                    <input type="text" name="quantity" id="quantity" value="{{ old('quantity', $producto->quantity) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Existencia">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="sku" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">SKU</label>
                                <div class="mt-2">
                                    <input type="text" name="sku" id="sku" value="{{ old('sku', $producto->sku) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="SKU">
                                </div>
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium leading-6 text-gray-900 dark:text-gray-200">Imagen</label>
                                <div class="mt-2">
                                    <input type="text" name="image" id="image" value="{{ old('image', $producto->image) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 dark:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Imagen">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                                Actualizar
                            </button>
                            <a href="{{ route('productos.index') }}" class="ml-4 inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
