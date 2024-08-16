@hasanyrole('administrador|gerente')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Devoluciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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

                <!-- Lista de devoluciones -->
                <h3 class="text-lg font-bold mt-6">Lista de Devoluciones</h3>
                <table class="min-w-full divide-y divide-gray-200 mt-4">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Venta ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($devoluciones as $devolucion)
                            <tr>
                                <td class="px-6 py-4">{{ $devolucion->venta_id }}</td>
                                <td class="px-6 py-4">{{ $devolucion->producto_id }}</td>
                                <td class="px-6 py-4">{{ $devolucion->cantidad }}</td>
                                <td class="px-6 py-4">${{ number_format($devolucion->monto, 2) }}</td>
                                <td class="px-6 py-4">{{ $devolucion->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
@else
<script>
    window.location.href = "{{ route('pos.index') }}";
</script>
@endhasanyrole
