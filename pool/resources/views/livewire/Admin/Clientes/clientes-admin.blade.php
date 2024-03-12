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
                    @if ($clientes->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay clientes</td>
                        </tr>
                    @else
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombres }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->documento }}</td>
                                <td>{{ $cliente->horas_jugadas }}</td>
                                <td>{{ $cliente->horas_regalo }}</td>
                                <td>{{ $cliente->ultima_visita }}</td>
                                <td><i class="fa-solid fa-circle" style="color: {{ $cliente->estado == 'activo' ? '#11ff00':'#ff0000' }}"></i></td>
                                <td><button type="button" class="btn btn-success"
                                    wire:click='actualizarIdCliente({{ $cliente->id }}, 3)'>Editar</button></td>
                                @if ($cliente->estado == 'activo')
                                    <td><button type="button" class="btn btn-danger"
                                    wire:click='actualizarIdCliente({{ $cliente->id }}, 1)'>Eliminar</button></td>
                                @else
                                    <td><button type="button" class="btn btn-success"
                                        wire:click='actualizarIdCliente({{ $cliente->id }}, 2)'>Activar</button></td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <x-modal-confirmacion id="modalConfirmacionEliminar" funcion="eliminarCliente">Desea realmente eliminar este cliente?</x-modal-confirmacion>
            <x-modal-confirmacion id="modalConfirmacionActivar" funcion="activarCliente">Desea realmente activar este cliente?</x-modal-confirmacion>
        </div>
        @include('livewire.Admin.Clientes.modal-editar-cliente-admin')
        @include('livewire.Admin.Clientes.modal-crear-cliente-admin')


        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalEditarCliente = new bootstrap.Modal('#modalEditarCliente');
                const modalCrearCliente = new bootstrap.Modal('#modalCrearCliente');
                const modalConfirmacionEliminar = new bootstrap.Modal('#modalConfirmacionEliminar');
                const modalConfirmacionActivar = new bootstrap.Modal('#modalConfirmacionActivar');
                

                @this.on('show-modal-editar-cliente', msg => {
                    modalEditarCliente.show();
                });
                @this.on('hide-modal-editar-cliente', msg => {
                    modalEditarCliente.hide();
                });

                @this.on('show-modal-crear-cliente', msg => {
                    modalCrearCliente.show();
                });
                @this.on('hide-modal-crear-cliente', msg => {
                    modalCrearCliente.hide();
                });

                @this.on('show-modal-eliminar-cliente', msg => {
                    modalConfirmacionEliminar.show();
                });
                @this.on('hide-modal-eliminar-cliente', msg => {
                    modalConfirmacionEliminar.hide();
                });
                @this.on('show-modal-activar-cliente', msg => {
                    modalConfirmacionActivar.show();
                });
                @this.on('hide-modal-activar-cliente', msg => {
                    modalConfirmacionActivar.hide();
                });
            });
        </script>
    </div>
</div>