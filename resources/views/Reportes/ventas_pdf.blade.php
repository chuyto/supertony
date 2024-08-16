<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>

    <h1>Reporte de Ventas</h1>
    <p>Desde: {{ $startDate }} Hasta: {{ $endDate }}</p>
    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha de Venta</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                @foreach ($venta->productos as $producto)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha_venta->format('d/m/Y') }}</td>
                        <td>{{ $producto->name }}</td>
                        <td>{{ $producto->pivot->cantidad }}</td>
                        <td>{{ $producto->pivot->precio_total }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
