<x-modal title="Facturar al cliente" id="modalFacturaMesa">
    @if ($detalles_factura == null or empty($detalles_factura))
        <div class="card border-success-subtle mb-2">
            <div class="card-body">
                <p class="card-text">La factura no tiene productos</p>
            </div>
        </div>
    @else
        @foreach ($detalles_factura as $index => $detalle_factura)
            <div class="card border-success-subtle mb-2">
                <div class="card-body text-success row">
                    <h6 class="fw-bold col-4 mt-1">Producto:</h6>
                    <p class="card-text col-8">{{ $detalle_factura->producto->nombre }}</p>
                    <hr>
                    <h6 class="fw-bold col-4 mt-1">Cantidad:</h6>
                    <p class="card-text col-8">{{ $detalle_factura->cantidad }}</p>
                    <hr>
                    <h6 class="fw-bold col-4 mt-1">Subtotal:</h6>
                    <p class="card-text col-8">{{ $detalle_factura->subtotal }}</p>
                </div>
            </div>
        @endforeach
        <div class="card border-success-subtle mb-2">
            <div class="card-body text-success row">
                <h6 class="fw-bold col-4 mt-1">Total:</h6>
                <p class="card-text col-8">{{ $factura->total }}</p>
            </div>
        </div>
    @endif
</x-modal>
