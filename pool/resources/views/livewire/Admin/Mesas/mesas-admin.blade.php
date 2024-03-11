<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Clientes</h1>
        <div class="d-sm-flex align-items-left justify-content-between mb-4">
            <button wire:click="abrirModalCrear" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar</button>
            
            <div class="input-group" style="width: 75%">
                <input type="text" class="form-control border-success text-success" placeholder="Busqueda" aria-label="Busqueda" wire:model.blur="search">
                <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Horas Jugadas</th>
                        <th scope="col">Horas Regalo</th>
                        <th scope="col">Última Visita</th>
                        <th scope="col">Estado</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($mesas->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay mesas</td>
                        </tr>
                    @else
                        @foreach ($mesas as $mesa)
                            <tr>
                                <td>Equisde</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalEditarCliente = new bootstrap.Modal('#modalEditarCliente');


                @this.on('show-modal-editar-cliente', msg => {
                    modalEditarCliente.show();
                });
                @this.on('hide-modal-editar-cliente', msg => {
                    modalEditarCliente.hide();
                });

            });
        </script>
    </div>
</div>