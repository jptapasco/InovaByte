<x-modal title="Ver horas de  {{ $documento_cliente }}" id="modalVerHoras" type="edit">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            <div class="card border-success-subtle mb-2">
                <div class="card-body text-success">
                    <p class="card-text">{{ $datos_factura->hora_inicio }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                        <div class="col-9">
                            <p class="card-text">{{ $datos_factura->hora_fin }}</p>
                        </div>
                        <div class="col-2 ms-3">
                            <button class="btn btn-sm btn-outline-success" wire:click='deleteObservacion({{$detalle_empleado->id}})'>Eliminar</button>
                        </div>
                    </div>
                </ul>
            </div>

        </div>
    </div>
</x-modal>
