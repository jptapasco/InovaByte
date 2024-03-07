<x-modal title="Ver horas de {{ $nombre_cliente_factura }}" id="modalVerHoras">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            <div class="card border-success-subtle text-center">
                <div class="card-body text-success row">
                    <div class="col">
                        <h5 class="fw-bold">Hora inicio: </h5>
                        <p>{{ $hora_inicio_factura }}</p>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                        @if ($hora_fin_factura == null)
                            <h5 class="fw-bold">Jugando...</h5>
                        @else
                            <h5 class="fw-bold">Hora fin: </h5>
                            <p>{{ $hora_fin_factura }}</p>
                        @endif
                    </div>
                </ul>
            </div>

        </div>
    </div>
</x-modal>
