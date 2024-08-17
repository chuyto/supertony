<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <!-- Restricción por roles -->
                @hasanyrole('administrador|gerente')
                <div class="bg-gray-900">
                    <div class="mx-auto max-w-7xl">
                        <div class="bg-white py-10">
                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="sm:flex sm:items-center">
                                    <div class="sm:flex-auto">
                                        <h1 class="text-base font-semibold leading-6 text-gray-900">Productos</h1>
                                        <p class="mt-2 text-sm text-gray-300"></p>
                                    </div>
                                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                        <a href="{{ route('productos.create') }}" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                            Agregar producto
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-8 flow-root">
                                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                            <table class="min-w-full divide-y divide-gray-700">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">ID</th>
                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nombre Producto</th>
                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Categoria</th>
                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Precio</th>
                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Existencia</th>
                                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">SKU</th>
                                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y text-gray-900">
                                                    @foreach ($Productos as $producto)
                                                    <tr id="producto-{{ $producto->id }}">
                                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $producto->id }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $producto->name }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $producto->categoria->categoria ?? 'Sin categoría' }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $producto->price }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $producto->quantity }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $producto->sku }}</td>
                                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                                            <div class="flex justify-center">
                                                                <a href="{{ route('productos.edit', $producto->id) }}"
                                                                  class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                                                  Editar</a>
                                                                <button type="button" onclick="confirmDelete('{{ $producto->id }}')" class="ml-4 inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                    Eliminar
                                                                </button>
                                                            </div>
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
                    </div>
                </div>
                @else
                <script>
                    window.location.href = "{{ route('pos.index') }}";
                </script>
                @endhasanyrole
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div id="confirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Eliminar Producto</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirmDeleteButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Eliminar
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            const confirmationModal = document.getElementById('confirmationModal');
            if (confirmationModal) {
                confirmationModal.classList.remove('hidden');
                document.getElementById('confirmDeleteButton').onclick = function () {
                    deleteProduct(id);
                };
            } else {
                console.error('No se encontró el elemento modal de confirmación.');
            }
        }

        function closeModal() {
            document.getElementById('confirmationModal').classList.add('hidden');
        }

        function deleteProduct(id) {
            fetch(`/productos/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ _method: 'DELETE' }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar la tabla
                    document.querySelector(`#producto-${id}`).remove();

                    // Mostrar notificación de éxito
                    document.getElementById('successNotification').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('successNotification').classList.add('hidden');
                    }, 3000);
                } else {
                    // Manejo de error si es necesario
                }
                closeModal();
            })
            .catch(error => {
                console.error('Error:', error);
                closeModal();
            });
        }
    </script>
</x-app-layout>
