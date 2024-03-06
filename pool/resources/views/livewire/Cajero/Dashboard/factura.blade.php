<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Detalles del pedido</h1>
        <div class="mt-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad a Llevar</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$productosSeleccionados)
                    <tr>
                        <td colspan="3" class="text-center">No hay productos</td>
                    </tr>
                    @else
                    @foreach ($productosSeleccionados as $index => $item)
                    <tr>
                        <td>{{ $item['producto']->nombre }}</td>
                        <td>{{ $item['producto']->precio_venta }}</td>
                        <td>{{ $item['cantidad_a_llevar'] }}</td>
                    </tr>
                    
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>