@hasanyrole('administrador|gerente')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 sm:rounded-lg lg:px-8">

            <div class="p-6">
                <!-- Contenedor principal -->
                <div class="space-y-4">
                    <!-- Fila para las alertas de productos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if (count($lowStockProducts) > 0)
                        <div class="flex rounded-md bg-yellow-50 p-4">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Productos bajos de stock</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <ul>
                                        @foreach ($lowStockProducts as $product)
                                            <li>{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if (!$NoProductsInStock->isEmpty())
                        <div class="flex rounded-md bg-red-50 p-4">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Productos sin stock</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul>
                                        @foreach ($NoProductsInStock as $product)
                                            <li>{{ $product->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Fila para la alerta de descuentos -->
                    @if ($expiringDiscounts->isNotEmpty())
                    <div class="flex rounded-md bg-blue-50 p-4">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                              </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Descuentos por vencer mañana</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul>
                                    @foreach ($expiringDiscounts as $discount)
                                        <li>{{ $discount->name }} - Expira el {{ $discount->expiration }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>


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
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
          </svg>

    </div>
    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
        <div class="flex-1 truncate px-4 py-2 text-sm">
            <a href="{{ route('devoluciones.index') }}" class="font-medium text-gray-900 hover:text-gray-600">Devoluciones</a>
            <p class="text-gray-500"></p>
        </div>
        <div class="flex-shrink-0 pr-2">
            <a href="{{ route('devoluciones.index') }}" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="sr-only">Open options</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
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
@else
<script>
    window.location.href = "{{ route('pos.index') }}";
</script>
@endhasanyrole
