<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pos;

class PosController extends Controller
{
    public function completeSale(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'items' => 'required|json'
    ]);

    $items = json_decode($request->input('items'), true);
    $subtotal = 0; // Usar subtotal en lugar de total para representar la suma de los productos
    $total = 0;

    // Procesar la venta
    foreach ($items as $item) {
        // Asegurarse de que el producto existe
        $producto = Producto::find($item['id']);
        if (!$producto) {
            return response()->json(['status' => 'error', 'message' => 'Producto no encontrado'], 404);
        }

        // Verificar la cantidad en stock
        if ($producto->quantity < $item['quantity']) {
            return response()->json(['status' => 'error', 'message' => 'Cantidad insuficiente'], 400);
        }

        // Registrar la venta
        Pos::create([
            'producto_id' => $producto->id,
            'cantidad' => $item['quantity'],
            'precio_total' => $item['total'],
            'fecha_venta' => now()
        ]);

        // Actualizar el inventario
        $producto->quantity -= $item['quantity'];
        $producto->save();

        // Calcular subtotal y total
        $subtotal += $item['total'];
        $total = $subtotal; // El total puede ser igual al subtotal, pero puedes añadir impuestos u otros cargos si lo deseas.
    }

    // Responder con éxito
    return response()->json([
        'status' => 'success',
        'message' => 'Compra finalizada con éxito',
        'receipt' => [
            'items' => $items,
            'subtotal' => $subtotal, // Incluye el subtotal
            'total' => $total
        ]
    ]);
}

    public function index()
    {
        return view('pos.index');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('pos.show', compact('producto'));
    }

    public function searchProduct(Request $request)
    {
        $sku = $request->query('sku');
        $product = Producto::where('sku', $sku)->first();

        if ($product) {
            return response()->json([
                'status' => 'success',
                'product' => $product
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Producto no encontrado'
            ]);
        }
    }

    public function addProductToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Aquí puedes tener una lógica para almacenar el carrito en sesión o en base de datos
        // Por simplicidad, supongamos que estás usando sesión para almacenar el carrito.

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Si el producto ya está en el carrito, actualizar la cantidad
            $cart[$productId]['quantity'] += $quantity;
            $cart[$productId]['total'] = $cart[$productId]['price'] * $cart[$productId]['quantity'];
        } else {
            // Si el producto no está en el carrito, agregarlo
            $product = Producto::find($productId);
            if ($product) {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'total' => $product->price * $quantity
                ];
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'cart' => $cart
        ]);
    }
}
