<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card 1 -->
                    <div class="col-span-1 flex rounded-md shadow-sm">
                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-pink-600 rounded-l-md text-sm font-medium text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="{{ route('productos.index') }}" class="font-medium text-gray-900 hover:text-gray-600">Cargar Productos</a>
                                <p class="text-gray-500"></p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <a  href="{{ route('productos.index') }}" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open options</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-span-1 flex rounded-md shadow-sm">
                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-purple-600 rounded-l-md text-sm font-medium text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="{{ route('pos.index') }}" class="font-medium text-gray-900 hover:text-gray-600">Procesar venta</a>
                                <p class="text-gray-500"></p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open options</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-span-1 flex rounded-md shadow-sm">
                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-yellow-500 rounded-l-md text-sm font-medium text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Reportes</a>
                                <p class="text-gray-500"></p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open options</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-span-1 flex rounded-md shadow-sm">
                        <div class="flex w-16 flex-shrink-0 items-center justify-center bg-green-500 rounded-l-md text-sm font-medium text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.75a9 9 0 0 1-9 9 9 9 0 0 1-9-9 9 9 0 0 1 9-9 9 9 0 0 1 9 9Zm-9-6a6 6 0 0 0-6 6 6 6 0 0 0 6 6 6 6 0 0 0 6-6 6 6 0 0 0-6-6ZM12 14.25a2.25 2.25 0 0 1-2.25-2.25A2.25 2.25 0 0 1 12 9.75 2.25 2.25 0 0 1 14.25 12 2.25 2.25 0 0 1 12 14.25Z" />
                            </svg>
                        </div>
                        <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                            <div class="flex-1 truncate px-4 py-2 text-sm">
                                <a href="#" class="font-medium text-gray-900 hover:text-gray-600">Configuración</a>
                                <p class="text-gray-500"></p>
                            </div>
                            <div class="flex-shrink-0 pr-2">
                                <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="sr-only">Open options</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Chart for Sales by Day -->
                    <div class="chart-container p-4 border rounded-md" id="salesChartContainer">
                        <h3 class="text-lg font-semibold mb-4">Ventas por Día del Mes</h3>
                        <canvas id="salesChart"></canvas>
                    </div>

                    <!-- Chart for Top Selling Products -->
                    <div class="chart-container p-4 border rounded-md" id="productChartContainer">
                        <h3 class="text-lg font-semibold mb-4">Productos Más Vendidos</h3>
                        <canvas id="productChart"></canvas>
                    </div>

                    <!-- Chart for Sales by Month -->
                    <div class="chart-container p-4 border rounded-md col-span-2" id="monthlySalesChartContainer">
                        <h3 class="text-lg font-semibold mb-4">Ventas por Mes</h3>
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs@latest/dist/interact.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    function createChart(ctx, data, type) {
        return new Chart(ctx, {
            type: type,
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    var ctxSales = document.getElementById('salesChart').getContext('2d');
    var salesChart = createChart(ctxSales, {
        labels: @json($days),
        datasets: [{
            label: 'Ventas por Día del Mes',
            data: @json($totals),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2
        }]
    }, 'line');

    var ctxProducts = document.getElementById('productChart').getContext('2d');
    var productChart = createChart(ctxProducts, {
        labels: @json($productNames),
        datasets: [{
            label: 'Productos Más Vendidos',
            data: @json($productTotals),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 2
        }]
    }, 'bar');

    var ctxMonthlySales = document.getElementById('monthlySalesChart').getContext('2d');
    var monthlySalesChart = createChart(ctxMonthlySales, {
        labels: @json($months),
        datasets: [{
            label: 'Ventas por Mes',
            data: @json($monthlyTotals),
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 2
        }]
    }, 'bar');

    function makeResizableDraggable(selector, chart) {
        interact(selector).draggable({
            listeners: {
                move(event) {
                    var target = event.target;
                    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
                    target.style.transform = `translate(${x}px, ${y}px)`;
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                    saveChartSettings(selector);
                }
            }
        }).resizable({
            edges: { left: true, right: true, bottom: true, top: true },
            listeners: {
                move(event) {
                    var target = event.target;
                    var x = parseFloat(target.getAttribute('data-x')) || 0;
                    var y = parseFloat(target.getAttribute('data-y')) || 0;
                    // Set width and height without applying translate
                    target.style.width = `${event.rect.width}px`;
                    target.style.height = `${event.rect.height}px`;
                    target.style.transform = `translate(${x}px, ${y}px)`;
                    target.setAttribute('data-x', x);
                    target.setAttribute('data-y', y);
                    saveChartSettings(selector);
                    chart.resize();
                }
            }
        });
    }

    function saveChartSettings(selector) {
        var container = document.querySelector(selector);
        var settings = {
            width: container.offsetWidth,
            height: container.offsetHeight,
            x: parseFloat(container.getAttribute('data-x')) || 0,
            y: parseFloat(container.getAttribute('data-y')) || 0
        };
        localStorage.setItem(selector, JSON.stringify(settings));
    }

    function loadChartSettings(selector) {
        var settings = JSON.parse(localStorage.getItem(selector));
        if (settings) {
            var container = document.querySelector(selector);
            container.style.width = `${settings.width}px`;
            container.style.height = `${settings.height}px`;
            container.style.transform = `translate(${settings.x}px, ${settings.y}px)`;
            container.setAttribute('data-x', settings.x);
            container.setAttribute('data-y', settings.y);
        }
    }

    makeResizableDraggable('#salesChartContainer', salesChart);
    makeResizableDraggable('#productChartContainer', productChart);
    makeResizableDraggable('#monthlySalesChartContainer', monthlySalesChart);

    // Load saved settings
    loadChartSettings('#salesChartContainer');
    loadChartSettings('#productChartContainer');
    loadChartSettings('#monthlySalesChartContainer');
});


</script>
<style>
    .chart-container {
        height: 300px; /* Ajusta la altura según sea necesario */
        resize: both;
    }

    .chart-container canvas {
        width: 100%;
        height: 100%;
    }

    .chart-container .chart-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .chart-container .chart-subtitle {
        font-size: 0.9rem;
        color: #999;
        margin-bottom: 1rem;
    }


</style>
