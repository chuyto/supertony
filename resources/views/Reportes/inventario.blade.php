@hasanyrole('administrador|gerente')
<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Inventario</title>
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
            width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>Reporte de Inventario</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Producto</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>SKU</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->description }}</td>
                    <td>{{ $producto->category_id }}</td>
                    <td>{{ $producto->price }}</td>
                    <td>{{ $producto->quantity }}</td>
                    <td>{{ $producto->sku }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
@else
<script>
    window.location.href = "{{ route('pos.index') }}";
</script>
@endhasanyrole
