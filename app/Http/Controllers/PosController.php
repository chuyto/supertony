<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Settings;

class PosController extends Controller
{
    // Mostrar la vista del punto de venta
    public function index()
    {
        return view('pos.index');
    }

    // Mostrar el nombre de la compañía
    public function companyName()
{
    $companyName = Settings::get('name_company');

    // Decodificar el JSON si es necesario
    if (is_string($companyName)) {
        $decoded = json_decode($companyName, true);
        if (is_array($decoded) && isset($decoded['name_company'])) {
            $companyName = $decoded['name_company'];
        } else {
            // Si no es un JSON válido, trata de usar el valor tal como está
            $companyName = strval($companyName);
        }
    } else {
        $companyName = strval($companyName);
    }

    if (!is_string($companyName)) {
        return response()->json([
            'status' => 'error',
            'message' => 'El nombre de la compañía no es una cadena de texto'
        ]);
    }

    return response()->json([
        'status' => 'success',
        'company_name' => $companyName
    ]);
}


    // Buscar un producto por SKU
    public function searchProduct(Request $request)
    {
        $sku = $request->query('sku');
        $product = Producto::with('descuento')->where('sku', $sku)->first();

        if ($product) {
            $productData = $product->toArray();
            $productData['percentage'] = $product->descuento ? $product->descuento->percentage : 0;

            return response()->json([
                'status' => 'success',
                'product' => $productData
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ]);
        }
    }

    public function completeSale(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'items' => 'required|json',
            'monto_pagado' => 'required|numeric|min:0',
        ]);

        $items = json_decode($request->input('items'), true);
        $subtotal = 0;
        $montoPagado = $request->input('monto_pagado');

        foreach ($items as $item) {
            $producto = Producto::with('descuento')->find($item['id']);
            if (!$producto) {
                return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
            }

            if ($producto->quantity < $item['quantity']) {
                return response()->json(['status' => 'error', 'message' => 'Cantidad insuficiente'], 400);
            }

            // Calcular el precio con el descuento aplicado (si corresponde)
            $precioFinal = $producto->price;
            if ($producto->descuento && $producto->descuento->is_active && now()->lessThan($producto->descuento->expiration)) {
                $descuento = $producto->price * ($producto->descuento->percentage / 100);
                $precioFinal = $producto->price - $descuento;
            }

            $itemTotal = $precioFinal * $item['quantity'];
            $subtotal += $itemTotal;
        }

        $venta = Venta::create([
            'total' => $subtotal,
            'monto_pagado' => $montoPagado,
        ]);

        foreach ($items as $item) {
            $producto = Producto::find($item['id']);
            $producto->ventas()->attach($venta->id, [
                'cantidad' => $item['quantity'],
                'precio_total' => $itemTotal
            ]);

            $producto->quantity -= $item['quantity'];
            $producto->save();
        }

        // Obtener el nombre de la compañía
        $companyName = Settings::get('name_company');

        // Decodificar el JSON si es necesario
        if (is_string($companyName)) {
            $decoded = json_decode($companyName, true);
            if (is_array($decoded) && isset($decoded['name_company'])) {
                $companyName = $decoded['name_company'];
            } else {
                $companyName = strval($companyName);
            }
        } else {
            $companyName = strval($companyName);
        }

        if (!is_string($companyName)) {
            return response()->json([
                'status' => 'error',
                'message' => 'El nombre de la compañía no es una cadena de texto'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Compra finalizada con éxito',
            'receipt' => [
                'items' => $items,
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'name_company' => $companyName
            ]
        ]);
    }


    // Agregar un producto al carrito (en sesión)
    public function addProductToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Producto::find($productId);
            if ($product) {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity
                ];
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'cart' => $cart
        ]);
    }

    // Obtener el carrito de compras
    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json([
            'status' => 'success',
            'cart' => $cart
        ]);
    }

    // Vaciar el carrito
    public function clearCart()
    {
        session()->forget('cart');
        return response()->json([
            'status' => 'success',
            'message' => 'Carrito vacío'
        ]);
    }
}
