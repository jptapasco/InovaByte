<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Mesas</h1>
        <div class="d-sm-flex align-items-left justify-content-between mb-4">
            <button wire:click="abrirModalCrear" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar</button>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Tipo Mesa</th>
                        <th scope="col">Mesera</th>
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
                                <td>{{ $mesa->numero }}</td>
                                <td>{{ $mesa->nombre_mesa }}</td>
                                <td class="{{ $mesa->nombre_mesera ? '' : 'text-danger' }}">{{ $mesa->nombre_mesera ? $mesa->nombre_mesera : "Sin Asignar" }}</td>
                                <td><button type="button" class="btn btn-success"
                                    wire:click='actualizarIdMesa({{ $mesa->id }}, 3)'>Editar</button></td>
                                @if ($mesa->estado == 'activo')
                                    <td><button type="button" class="btn btn-danger {{ $mesa->nombre_mesera ? 'disabled' : '' }}"
                                            wire:click='actualizarIdMesa({{ $mesa->id }}, 1)'>Eliminar</button>
                                    </td>
                                @else
                                    <td><button type="button" class="btn btn-success"
                                        wire:click='actualizarIdMesa({{ $mesa->id }}, 2)'>Activar</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <x-modal-confirmacion id="modalConfirmacionEliminar" funcion="eliminarMesa">Desea realmente eliminar esta mesa?</x-modal-confirmacion>
        <x-modal-confirmacion id="modalConfirmacionActivar" funcion="activarMesa">Desea realmente activar esta mesa?</x-modal-confirmacion>

        @include('livewire.Admin.Mesas.modal-crear-mesa-admin')
        @include('livewire.Admin.Mesas.modal-editar-mesa-admin')

        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalCrearMesa = new bootstrap.Modal('#modalCrearMesa');
                const modalEditarMesa = new bootstrap.Modal('#modalEditarMesa');
                const modalConfirmacionEliminar = new bootstrap.Modal('#modalConfirmacionEliminar');
                const modalConfirmacionActivar = new bootstrap.Modal('#modalConfirmacionActivar');

                @this.on('show-modal-crear-mesa', msg => {
                    modalCrearMesa.show();
                });
                @this.on('hide-modal-crear-mesa', msg => {
                    modalCrearMesa.hide();
                });

                @this.on('show-modal-editar-mesa', msg => {
                    modalEditarMesa.show();
                });
                @this.on('hide-modal-editar-mesa', msg => {
                    modalEditarMesa.hide();
                });

                @this.on('show-modal-eliminar-mesa', msg => {
                    modalConfirmacionEliminar.show();
                });
                @this.on('hide-modal-eliminar-mesa', msg => {
                    modalConfirmacionEliminar.hide();
                });
                @this.on('show-modal-activar-mesa', msg => {
                    modalConfirmacionActivar.show();
                });
                @this.on('hide-modal-activar-mesa', msg => {
                    modalConfirmacionActivar.hide();
                });
            });
        </script>
    </div>
</div>