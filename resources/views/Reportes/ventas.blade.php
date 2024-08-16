@hasanyrole('administrador|gerente')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generar Reporte de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <form action="{{ route('reportes.ventas.pdf') }}" method="GET" class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <label for="start_date" class="block text-gray-700 dark:text-gray-400">Fecha de Inicio:</label>
                            <input type="date" id="start_date" name="start_date" class="border-gray-300 dark:border-gray-700 rounded-lg" required>
                        </div>

                        <div class="flex items-center space-x-4">
                            <label for="end_date" class="block text-gray-700 dark:text-gray-400">Fecha de Fin:</label>
                            <input type="date" id="end_date" name="end_date" class="border-gray-300 dark:border-gray-700 rounded-lg" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Generar Reporte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else
<script>
    window.location.href = "{{ route('pos.index') }}";
</script>
@endhasanyrole
