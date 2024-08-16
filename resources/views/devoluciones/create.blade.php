<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Devolución') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Formulario para registrar devoluciones -->
                <form action="{{ route('devoluciones.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="venta_id" class="block text-gray-700 font-medium mb-2">ID de Venta</label>
                        <input type="number" id="venta_id" name="venta_id" class="form-input mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="producto_id" class="block text-gray-700 font-medium mb-2">ID de Producto</label>
                        <input type="number" id="producto_id" name="producto_id" class="form-input mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="cantidad" class="block text-gray-700 font-medium mb-2">Cantidad</label>
                        <input type="number" id="cantidad" name="cantidad" class="form-input mt-1 block w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="monto" class="block text-gray-700 font-medium mb-2">Monto</label>
                        <input type="number" id="monto" name="monto" class="form-input mt-1 block w-full" step="0.01" required>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Registrar Devolución</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
