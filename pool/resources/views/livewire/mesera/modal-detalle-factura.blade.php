<div class="modal fade" id="modalDetalleFactura" function="abrirModalDetalleFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1>Detalle Factura</h1>
            </div>
            <div class="modal-body bg-success bg-opacity-25">
                <div class="card-body bg-white" style="border-radius: 5px;">
                    <table class="table table-bordered table-success border-success text-center">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($factura_detalle)
                            @foreach($factura_detalle as $detalle)
                                <tr>
                                    <td>
                                        {{ $detalle->nombre_producto }}
                                    </td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->subtotal }}</td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>                                                                                                             
                    </table>                    
                </div>                
            </div>            
            <div class="modal-footer bg-success bg-opacity-50">
                <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>