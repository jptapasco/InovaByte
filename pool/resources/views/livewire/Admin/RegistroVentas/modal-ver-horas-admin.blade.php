<x-modal title="Ver horas de " id="modalVerHoras">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            <div class="card border-success-subtle mb-2 text-center">
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                        <div class="col">
                            <h5 class="fw-bold">Hora inicio: </h5>
                            <p>{{ $hora_inicio_factura }}</p>
                        </div>
                    </div>
                </ul>
                <ul class="list-group list-group-flush">
                    <div class="card-body text-success row">
                    <div class="col">
                            <h5 class="fw-bold">Hora fin: </h5>
                            <p>{{ $hora_fin_factura }}</p>
                        </div>
                    </div>
                </ul>
            </div>

        </div>
    </div>
</x-modal>
