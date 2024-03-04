<x-modal title="Observaciones de {{ $nombres_empleados }}" id="modalObservaciones" type="custom" button="Agregar" function="abrirModalObservacion">
    @if ($detalles_empleados == null or $detalles_empleados->count() == 0)
        <div class="card">
            <div class="card-body">
                <p class="card-text">El empleado no tiene observaciones :D</p>
            </div>
        </div>
    @else
        @foreach ($detalles_empleados as $detalle_empleado)
            <div class="card border-success-subtle mb-2">
                <div class="card-body text-success">
                    <p class="card-text">{{ $detalle_empleado->observacion }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                        <div class="col-9">
                            <p class="card-text">{{ $detalle_empleado->updated_at->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-2 ms-3">
                            <button class="btn btn-sm btn-outline-success" wire:click='deleteObservacion({{$detalle_empleado->id}})'>Eliminar</button>
                        </div>
                    </div>
                </ul>
            </div>
        @endforeach
    @endif
</x-modal>
