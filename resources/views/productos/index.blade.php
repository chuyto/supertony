<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Productos List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            
         

            <div class="bg-gray-900">
                <div class="mx-auto max-w-7xl">
                  <div class="bg-gray-900 py-10">
                    <div class="px-4 sm:px-6 lg:px-8">
                      <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                          <h1 class="text-base font-semibold leading-6 text-white">Productos</h1>
                          <p class="mt-2 text-sm text-gray-300"></p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                          <a href="{{ route('productos.create') }}" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Agregar producto</a>
                        </div>
                      </div>
                      <div class="mt-8 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Nombre Producto</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Categoria</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Precio</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Existencia</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">SKU</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Acciones</th>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($Productos as $producto)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">{{ $producto->id }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $producto->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $producto->category }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $producto->price }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $producto->quantity }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $producto->SKU }}</td>
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
          
                
                              

            </div>
        </div>
    </div>
</x-app-layout>
