<div>
    <div class=" card p-5 my-3">
        <h1 class="text-success">Usuarios</h1>
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
                        <th scope="col">Rol</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col" colspan="2">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($usuarios->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay usuarios</td>
                        </tr>
                    @else
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->rol }}</td>
                                <td>{{ $usuario->nombres }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->telefono }}</td>
                                <td>{{ $usuario->documento }}</td>
                                <td><i class="fa-solid fa-circle"
                                        style="color: {{ $usuario->estado == 'activo' ? '#11ff00' : '#ff0000' }}"></i>
                                </td>
                                <td><button type="button" class="btn btn-success"
                                        wire:click='cargarObservaciones({{ $usuario->id }})'>Detalles</button></td>
                                <td><button type="button" class="btn btn-success"
                                        wire:click='actualizarIdUsuario({{ $usuario->id }}, 3)'>Editar</button></td>
                                @if ($usuario->estado == 'activo')
                                    <td><button type="button" class="btn btn-danger"
                                            wire:click='actualizarIdUsuario({{ $usuario->id }}, 1)'>Eliminar</button>
                                    </td>
                                @else
                                    <td><button type="button" class="btn btn-success"
                                            wire:click='actualizarIdUsuario({{ $usuario->id }}, 2)'>Activar</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <x-modal-confirmacion id="modalConfirmacionEliminar" funcion="eliminarUsuario">Desea realmente eliminar este
                usuario?</x-modal-confirmacion>
            <x-modal-confirmacion id="modalConfirmacionActivar" funcion="activarUsuario">Desea realmente activar este
                usuario?</x-modal-confirmacion>
        </div>
        @include('livewire.Admin.Usuarios.modal-editar-usuario-admin')
        @include('livewire.Admin.Usuarios.modal-crear-usuario-admin')
        @include('livewire.Admin.Usuarios.modal-observaciones-usuario-admin')
        @include('livewire.Admin.Usuarios.modal-crear-observaciones-usuario-admin')

        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalEditarUsuario = new bootstrap.Modal('#modalEditarUsuario');
                const modalObservaciones = new bootstrap.Modal('#modalObservaciones');
                const modalCrearUsuario = new bootstrap.Modal('#modalCrearUsuario');
                const modalAddDetalles = new bootstrap.Modal('#modalAddDetalles');
                const modalConfirmacionEliminar = new bootstrap.Modal('#modalConfirmacionEliminar');
                const modalConfirmacionActivar = new bootstrap.Modal('#modalConfirmacionActivar');

                @this.on('show-modal-editar-usuario', msg => {
                    modalEditarUsuario.show();
                });
                @this.on('hide-modal-editar-usuario', msg => {
                    modalEditarUsuario.hide();
                });

                @this.on('show-modal-crear-usuario', msg => {
                    modalCrearUsuario.show();
                });
                @this.on('hide-modal-crear-usuario', msg => {
                    modalCrearUsuario.hide();
                });

                @this.on('show-modal-activar-usuario', msg => {
                    modalConfirmacionActivar.show();
                });
                @this.on('hide-modal-activar-usuario', msg => {
                    modalConfirmacionActivar.hide();
                });
                @this.on('show-modal-eliminar-usuario', msg => {
                    modalConfirmacionEliminar.show();
                });
                @this.on('hide-modal-eliminar-usuario', msg => {
                    modalConfirmacionEliminar.hide();
                });

                @this.on('show-modal-observaciones-usuario', msg => {
                    modalObservaciones.show();
                });
                @this.on('show-modal-add-obs', msg => {
                    modalAddDetalles.show();
                    modalObservaciones.hide();
                });
                @this.on('close-modal-add-obs', msg => {
                    modalAddDetalles.hide();
                    modalObservaciones.show();
                });
            });
        </script>
    </div>
</div>
