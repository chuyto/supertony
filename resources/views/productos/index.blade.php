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

    <script>
      function confirmDelete(id) {
          document.getElementById('confirmationModal').classList.remove('hidden');
          document.getElementById('confirmDeleteButton').onclick = function () {
              deleteProduct(id);
          };
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
