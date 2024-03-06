<div>
    <div class="bg-slight card p-5 my-3">
        <h1 class="text-success">Registro Ventas</h1>
        <div class="d-sm-flex align-items-left justify-content-left mb-4 mt-2">
            <div class="input-group" style="width: 28%">
                <h4 class="mt-1 me-1">Desde:</h4>
                <input type="text" class="form-control border-success text-success" placeholder="Busqueda" aria-label="Busqueda" wire:model.blur="search">
            </div>
            <div class="input-group me-3" style="width: 28%">
                <h4 class="mt-1 me-1">Hasta:</h4>
                <input type="text" class="form-control border-success text-success" placeholder="Busqueda" aria-label="Busqueda" wire:model.blur="search">
            </div>
            <button wire:click="abrirModalCrear" type="button" class="btn btn-success"><i class="fa-solid fa-filter"></i> Filtrar</button>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Total</th>
                        <th scope="col">Mesa</th>
                        <th scope="col">Cliente</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($facturas->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay facturas</td>
                        </tr>
                    @else
                        @foreach ($facturas as $factura)
                            <tr>
                                <td>{{ $factura->created_at }}</td>
                                <td>{{ $factura->nombres_vendedor }}</td>
                                <td>{{ $factura->total }}</td>
                                <td>{{ $factura->id_mesa }}</td>
                                <td>{{ $factura->documento_cliente }}</td>
                                @if ($factura->hora_inicio == null)
                                    <td><button type="button" class="btn btn-success disabled">Ver Horas</button></td>
                                @else
                                    <td><button type="button" class="btn btn-success"
                                            wire:click='verHoras({{ $factura->id }}, 2)'>Ver Horas</button>
                                    </td>
                                @endif
                                <td><button type="button" class="btn btn-success"
                                        wire:click='verDetalles({{ $factura->id }})'>Detalles</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @include('livewire.Admin.RegistroVentas.modal-ver-horas-admin')

        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalVerHoras = new bootstrap.Modal('#modalVerHoras');

                @this.on('show-modal', msg => {
                    modalVerHoras.show();
                });
                @this.on('show-modal-add-obs', msg => {
                    modalAddDetalles.show();
                    modalVerHoras.hide();
                });
                @this.on('close-modal-add-obs', msg => {
                    modalAddDetalles.hide();
                    modalVerHoras.show();
                });

            });
        </script>
    </div>
</div>