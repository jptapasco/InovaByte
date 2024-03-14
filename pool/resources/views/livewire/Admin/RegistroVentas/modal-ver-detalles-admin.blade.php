<x-modal title="Detalles factura de {{ $nombre_cliente_factura }}" id="modalVerDetalles">
    @if ($detalles_productos == null or empty($detalles_productos))
        <div class="card border-success-subtle mb-2">
            <div class="card-body">
                <p class="card-text">La factura no tiene productos</p>
            </div>
        </div>
    @else
        @foreach ($detalles_productos as $index => $detalle_producto)
            <div class="card border-success-subtle mb-2">
                <div class="card-body text-success row">
                    <h6 class="fw-bold col-4 mt-1">Producto:</h6>
                    <p class="card-text col-8">{{ $detalle_producto->nombre }}</p>
                    <hr>
                    <h6 class="fw-bold col-4 mt-1">Cantidad:</h6>
                    <p class="card-text col-8">{{ $cantidades_productos[$index] }}</p>
                    <hr>
                    <h6 class="fw-bold col-4 mt-1">Subtotal:</h6>
                    <p class="card-text col-8">{{ $subtotales_productos[$index] }}</p>
                </div>
            </div>
        @endforeach
    @endif
</x-modal>