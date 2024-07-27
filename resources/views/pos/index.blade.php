<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Punto de venta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mx-auto p-4">
                    <h1 class="text-2xl font-bold mb-4">Punto de Venta</h1>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full md:w-1/2 px-2 mb-4">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <label for="sku" class="block text-gray-700 font-medium mb-2">Código de Producto (SKU)</label>
                                <input type="text" id="sku" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ingrese SKU" />
                                <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" id="search-product">Buscar Producto</button>
                                <div id="product-info" class="mt-3"></div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-2 mb-4">
                            <div class="bg-white p-4 rounded-lg shadow-md">
                                <table class="min-w-full divide-y divide-gray-200" id="cart-table">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        {{-- Aquí se añadirían los productos en partidas --}}
                                    </tbody>
                                </table>
                                <form id="complete-sale-form" action="/pos/complete-sale" method="POST">
                                    @csrf
                                    <input type="hidden" name="items" id="cart-items">
                                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Finalizar Compra</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="alert-container" class="fixed top-0 right-0 mt-4 mr-4 z-50"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('search-product').addEventListener('click', function() {
        let sku = document.getElementById('sku').value;

        fetch(`/pos/search?sku=${sku}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                let productInfo = `
                    <p><strong>Nombre:</strong> ${data.product.name}</p>
                    <p><strong>Precio:</strong>$ ${data.product.price}</p>
                    <p><strong>Cantidad:</strong> ${data.product.quantity}</p>
                `;
                document.getElementById('product-info').innerHTML = productInfo;

                // Añadir el producto al carrito
                addToCart(data.product);
            } else {
                document.getElementById('product-info').innerHTML = '<p>Producto no encontrado</p>';
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    });

    let cart = [];

    function addToCart(product) {
        let productInCart = cart.find(item => item.id === product.id);

        if (productInCart) {
            // Actualizar la cantidad existente
            productInCart.quantity += 1;
            productInCart.total = productInCart.price * productInCart.quantity;
        } else {
            // Agregar nuevo producto al carrito
            cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1,
                total: product.price
            });
        }

        updateCartTable();
    }

    function updateCartTable() {
        let cartTable = document.getElementById('cart-table').getElementsByTagName('tbody')[0];
        cartTable.innerHTML = ''; // Limpiar la tabla antes de actualizar

        cart.forEach(item => {
            let row = cartTable.insertRow();

            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>${item.quantity}</td>
                <td>$${item.total}</td>
                <td>
                    <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="removeFromCart(${item.id})">Eliminar</button>
                </td>
            `;
        });

        // Actualizar el campo oculto con los datos del carrito
        document.getElementById('cart-items').value = JSON.stringify(cart);
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        updateCartTable();
    }

    document.getElementById('complete-sale-form').addEventListener('submit', function(e) {
        e.preventDefault();

        if (confirm('¿Estás seguro de que quieres finalizar la compra?')) {
            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showAlert('Compra finalizada con éxito', 'success');
                    printReceipt(data.receipt);
                } else {
                    showAlert('Error: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                showAlert('Hubo un problema con la operación.', 'error');
            });
        }
    });

    function showAlert(message, type) {
        let alertContainer = document.getElementById('alert-container');
        let alertClass = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        let textColor = type === 'success' ? 'text-white' : 'text-white';

        let alertDiv = document.createElement('div');
        alertDiv.className = `fixed top-0 right-0 mt-4 mr-4 p-4 rounded-lg ${alertClass} ${textColor}`;
        alertDiv.innerHTML = `
            <p>${message}</p>
            <button class="absolute top-0 right-0 p-2" onclick="this.parentElement.remove();">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
        alertContainer.appendChild(alertDiv);

        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }

    function printReceipt(receipt) {
    if (!receipt || !receipt.items) {
        console.error('Recibo inválido o sin items');
        return;
    }

    let printWindow = window.open('', '', 'height=400,width=600');
    printWindow.document.write('<html><head><title>Ticket de Compra</title>');
    printWindow.document.write('<style>body{font-family: Arial, sans-serif;} table{width: 100%; border-collapse: collapse;} th, td{border: 1px solid #ddd; padding: 8px;} th{text-align: left;} </style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h2>Ticket de Compra</h2>');
    printWindow.document.write('<table>');
    printWindow.document.write('<thead><tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead>');
    printWindow.document.write('<tbody>');

    receipt.items.forEach(item => {
        printWindow.document.write(`<tr><td>${item.name}</td><td>$${item.price}</td><td>${item.quantity}</td><td>$${item.total}</td></tr>`);
    });

    printWindow.document.write('</tbody>');
    printWindow.document.write('<tfoot><tr><td colspan="3" style="text-align: right;">Subtotal</td><td>$' + receipt.subtotal + '</td></tr>');
    printWindow.document.write('<tr><td colspan="3" style="text-align: right;">Total</td><td>$' + receipt.total + '</td></tr>');
    printWindow.document.write('</tfoot>');
    printWindow.document.write('</table>');
    printWindow.document.write('</body></html>');

    printWindow.document.close(); // Close the document for writing
    printWindow.focus(); // Focus on the print window
    setTimeout(() => {
        printWindow.print(); // Trigger print after ensuring content is loaded
    }, 100);
}


</script>
