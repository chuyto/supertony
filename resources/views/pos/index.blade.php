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
                                <div id="reader" class="mt-3" style="width: 300px; height: 300px; display: none;"></div>
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
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        {{-- Aquí se añadirían los productos en partidas --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right">Subtotal:</td>
                                            <td id="cart-subtotal">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Descuentos:</td>
                                            <td id="cart-discounts">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right">Total:</td>
                                            <td id="cart-total">$0.00</td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <form id="complete-sale-form" action="/pos/complete-sale" method="POST">
                                    @csrf
                                    <input type="hidden" name="items" id="cart-items">

                                    <div class="mt-4">
                                        <label for="monto_pagado" class="block text-sm font-medium text-gray-700">Monto Dado:</label>
                                        <input type="number" id="monto_pagado" name="monto_pagado" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Ingrese monto pagado" />
                                    </div>

                                    <div class="mt-4">
                                        <label for="cart-change" class="block text-sm font-medium text-gray-700">Cambio:</label>
                                        <span id="cart-change" class="block text-sm font-medium text-gray-900">$0.00</span>
                                    </div>

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
   document.addEventListener('DOMContentLoaded', function() {
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
                let product = data.product;
                if (product) {
                    let discountPercentage = parseFloat(product.percentage) || 0;
                    let productInfo = `
                        <p><strong>Nombre:</strong> ${product.name}</p>
                        <p><strong>Precio:</strong> $${product.price}</p>
                        <p><strong>Cantidad:</strong> ${product.quantity}</p>
                        <p><strong>Descuento:</strong> ${discountPercentage}%</p>
                    `;
                    document.getElementById('product-info').innerHTML = productInfo;
                    addToCart(product);
                } else {
                    document.getElementById('product-info').innerHTML = '<p>Producto no encontrado</p>';
                }
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
        let discountPercentage = parseFloat(product.percentage) || 0;

        if (productInCart) {
            productInCart.quantity += 1;
            productInCart.total = productInCart.price * productInCart.quantity * (1 - discountPercentage / 100);
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                quantity: 1,
                discount: discountPercentage,
                total: parseFloat(product.price) * (1 - discountPercentage / 100)
            });
        }

        updateCartTable();
        updateCartTotals();
    }

    function updateCartTable() {
        let cartTable = document.getElementById('cart-table').getElementsByTagName('tbody')[0];
        cartTable.innerHTML = '';

        cart.forEach(item => {
            let row = cartTable.insertRow();
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>${item.quantity}</td>
                <td>
                    <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="removeFromCart(${item.id})">Eliminar</button>
                </td>
            `;
        });

        document.getElementById('cart-items').value = JSON.stringify(cart);
        updateCartTotals();
    }

    function updateCartTotals() {
        let subtotal = 0;
        let totalDiscounts = 0;

        cart.forEach(item => {
            let itemTotal = item.price * item.quantity;
            let itemDiscount = itemTotal * (item.discount / 100);
            totalDiscounts += itemDiscount;
            subtotal += itemTotal;
        });

        let total = subtotal - totalDiscounts;
        document.getElementById('cart-subtotal').innerText = `$${subtotal.toFixed(2)}`;
        document.getElementById('cart-discounts').innerText = `$${totalDiscounts.toFixed(2)}`;
        document.getElementById('cart-total').innerText = `$${total.toFixed(2)}`;

        // Actualizar el campo de cambio
        updateChange();
    }

    function updateChange() {
        let total = parseFloat(document.getElementById('cart-total').innerText.replace('$', '')) || 0;
        let amountGiven = parseFloat(document.getElementById('monto_pagado').value) || 0;
        let change = amountGiven - total;
        document.getElementById('cart-change').innerText = `$${change.toFixed(2)}`;
    }

    document.getElementById('monto_pagado').addEventListener('input', updateChange);

    window.removeFromCart = function(productId) {
        cart = cart.filter(item => item.id !== productId);
        updateCartTable();
        updateCartTotals();
    };

    document.getElementById('complete-sale-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        console.log('Form Data:', Array.from(formData.entries()));

        if (confirm('¿Estás seguro de que quieres finalizar la compra?')) {
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

                    // Asegúrate de que `data.receipt` y `data.amountPaid` existen en la respuesta
                    let amountPaid = parseFloat(document.getElementById('monto_pagado').value) || 0;
                    printReceipt(data.receipt, amountPaid);

                    cart = [];
                    updateCartTable();
                    updateCartTotals();
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
        }, 3000);
    }
    function printReceipt(receipt, amountPaid) {
    if (!receipt || !receipt.items) {
        console.error('Recibo inválido o sin items');
        return;
    }

    // Verificar el tipo y valor de name_company en el frontend
    console.log('Tipo de name_company:', typeof receipt.name_company);
    console.log('Valor de name_company:', receipt.name_company);

    let companyName = receipt.name_company;
    if (typeof companyName !== 'string') {
        console.error('El nombre de la compañía no es una cadena de texto');
        return;
    }

    let subtotal = receipt.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
    let totalDiscounts = receipt.items.reduce((sum, item) => sum + (item.price * item.quantity * (item.discount / 100)), 0);
    let total = subtotal - totalDiscounts;

    if (isNaN(subtotal) || isNaN(totalDiscounts) || isNaN(total)) {
        console.error('Valores de recibo no son números válidos');
        return;
    }

    let printWindow = window.open('', '', 'height=400,width=600');
    printWindow.document.write('<html><head><title>Ticket de Compra</title>');
    printWindow.document.write('<style>body{font-family: Arial, sans-serif;} table{width: 100%; border-collapse: collapse;} th, td{border: 1px solid #000; padding: 8px; text-align: left;} th{background-color: #f2f2f2;} </style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('Nombre de la Compañía: ' + companyName);
    printWindow.document.write('<h1>Recibo</h1>');
    printWindow.document.write('<table><thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Descuento</th><th>Total</th></tr></thead><tbody>');

    receipt.items.forEach(item => {
        let itemTotal = item.price * item.quantity;
        let itemDiscount = itemTotal * (item.discount / 100);
        printWindow.document.write(`<tr><td>${item.name}</td><td>$${item.price.toFixed(2)}</td><td>${item.quantity}</td><td>$${itemDiscount.toFixed(2)}</td><td>$${(itemTotal - itemDiscount).toFixed(2)}</td></tr>`);
    });

    printWindow.document.write('</tbody></table>');
    printWindow.document.write('<h2>Subtotal: $' + subtotal.toFixed(2) + '</h2>');
    printWindow.document.write('<h2>Descuentos: $' + totalDiscounts.toFixed(2) + '</h2>');
    printWindow.document.write('<h2>Total: $' + total.toFixed(2) + '</h2>');
    printWindow.document.write('<h2>Pago: $' + amountPaid.toFixed(2) + '</h2>');
    printWindow.document.write('<h2>Cambio: $' + (amountPaid - total).toFixed(2) + '</h2>');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}


});
</script>
