<!-- resources/views/charts/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Chart for Sales by Day -->
                    <div class="p-4 border rounded-md">
                        <h3 class="text-lg font-semibold mb-4">Ventas por Día del Mes</h3>
                        <canvas id="salesChart"></canvas>
                    </div>

                    <!-- Chart for Top Selling Products -->
                    <div class="p-4 border rounded-md">
                        <h3 class="text-lg font-semibold mb-4">Productos Más Vendidos</h3>
                        <canvas id="productChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart for Sales by Day
            var ctxSales = document.getElementById('salesChart').getContext('2d');
            var salesChart = new Chart(ctxSales, {
                type: 'line', // Cambia a 'line' para un gráfico de líneas
                data: {
                    labels: @json($days),
                    datasets: [{
                        label: 'Ventas por Día del Mes',
                        data: @json($totals),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart for Top Selling Products
            var ctxProducts = document.getElementById('productChart').getContext('2d');
            var productChart = new Chart(ctxProducts, {
                type: 'bar', // Usa 'bar' o el tipo que prefieras
                data: {
                    labels: @json($productNames),
                    datasets: [{
                        label: 'Productos Más Vendidos',
                        data: @json($productTotals),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
