<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Meseras</h1>
        <select class="form-select" name="selectOpcion" wire:model="opcionSeleccionada" wire:change="actualizarMesera"
            aria-label="Default select example">
            <option value="todas">Todas</option>
            <option value="disponibles">Disponibles</option>
            <option value="asignadas">Asignadas</option>
        </select>
        <div class="mt-4">
            <table class="table table-bordered table-success border-success text-center">
                <thead>
                    <tr>
                        <th>Mesera</th>
                        <th>Estado</th>
                        <th>Mesas asignadas</th>
                        <th>Info</th>
                        <th>Cambiar Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lista_meseras as $mesera)
                        @if (
                            $opcionSeleccionada == 'todas' ||
                                ($opcionSeleccionada == 'disponibles' && $mesas_asignadas[$mesera->id] == 0) ||
                                ($opcionSeleccionada == 'asignadas' && $mesas_asignadas[$mesera->id] > 0))
                            <tr>
                                <td>{{ $mesera->nombres }}</td>
                                <td>{{ $mesera->estado }}</td>
                                <td>{{ $mesas_asignadas[$mesera->id] }}</td>
                                <td>
                                    @if ($mesera->estado == 'activo' && $mesas_asignadas[$mesera->id] > 0)
                                        <button type="button" class="btn btn-success btn-accion" wire:click='cargarMesasMesera({{ $mesera->id }})'>Ver</button></td>
                                    @else
                                        <button class="btn btn-success btn-accion" disabled>Ver</button>
                                    @endif
                                </td>
                                <td>
                                    @if ($mesera->estado == 'activo')
                                        @if ($mesas_asignadas[$mesera->id] == 0)
                                        <button type="button" class="btn btn-danger" wire:click='actualizarIdUsuario({{ $mesera->id }}, 1)'>Desactivar</button>
                                        @else
                                        <button class="btn btn-danger btn-accion" disabled>Desactivar</button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-success" wire:click='actualizarIdUsuario({{ $mesera->id }}, 2)' style="width: 100px">Activar</button>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <x-modal-confirmacion id="modalConfirmacionEliminar" funcion="eliminarUsuario">Desea realmente Desactivar este usuario?</x-modal-confirmacion>
            <x-modal-confirmacion id="modalConfirmacionActivar" funcion="activarUsuario">Desea realmente activar este usuario?</x-modal-confirmacion>
            @include('livewire.Cajero.Meseras.modal-info-mesas')

        </div>

        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalConfirmacionEliminar = new bootstrap.Modal('#modalConfirmacionEliminar');
                const modalConfirmacionActivar = new bootstrap.Modal('#modalConfirmacionActivar');
                const modalMesasMesera = new bootstrap.Modal('#modalMesasMesera');

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

                @this.on('show-modal', msg => {
                    modalMesasMesera.show();
                });
                @this.on('show-modal-add-obs', msg => {
                    modalMesasMesera.hide();
                });
                @this.on('close-modal-add-obs', msg => {
                    modalMesasMesera.show();
                });

            });
        </script>

    </div>
</div>
