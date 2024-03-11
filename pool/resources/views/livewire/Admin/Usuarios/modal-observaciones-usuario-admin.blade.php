<x-modal title="Observaciones de {{ $nombres_usuario }}" id="modalObservaciones" type="custom" button="Agregar" function="abrirModalObservacion">
    @if ($observaciones_usuario == null or $observaciones_usuario->count() == 0)
        <div class="card">
            <div class="card-body">
                <p class="card-text">El usuario no tiene observaciones :D</p>
            </div>
        </div>
    @else
        @foreach ($observaciones_usuario as $observacion_usuario)
            <div class="card border-success-subtle mb-2">
                <div class="card-body text-success">
                    <p class="card-text">{{ $observacion_usuario->observacion }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                        <div class="col-9">
                            <p class="card-text">{{ $observacion_usuario->updated_at->format('Y-m-d') }}</p>
                        </div>
                        <div class="col-2 ms-3">
                            <button class="btn btn-sm btn-outline-success" wire:click='deleteObservacion({{$observacion_usuario->id}})'>Eliminar</button>
                        </div>
                    </div>
                </ul>
            </div>
        @endforeach
    @endif
</x-modal>
