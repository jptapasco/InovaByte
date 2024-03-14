<div>


    <div class="bg-light card p-5 my-3">


        <h1 class="text-success">Empleados</h1>
        <div class="d-sm-flex align-items-left justify-content-between mb-4">
            <a href="/usuarios_admin" type="button" class="btn btn-success"><i class="fa-solid fa-user"></i> Gestión usuarios</a>
            <div class="input-group" style="width: 75%">
                <input type="text" class="form-control border-success text-success" placeholder="Busqueda" aria-label="Busqueda" wire:model.blur="search">
                <button class="btn btn-outline-success" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha Registro</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($empleados->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay empleados</td>
                        </tr>
                    @else
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->documento }}</td>
                                <td>{{ $empleado->nombres }}</td>
                                <td>{{ $empleado->created_at->format('Y-m-d') }}</td>
                                <td>{{ $empleado->estado }}</td>
                                <td>{{ $empleado->rol }}</td>
                                <td><button type="button" class="btn btn-success"
                                        wire:click='cargarObservacionesEmpleado({{ $empleado->id }})'>Detalles</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        
        @include('livewire.Admin.Dashboard.modal-observaciones-empleados-admin')
        @include('livewire.Admin.Dashboard.modal-crear-observaciones-empleados')

        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalObservaciones = new bootstrap.Modal('#modalObservaciones');
                const modalAddDetalles = new bootstrap.Modal('#modalAddDetalles');

                @this.on('show-modal', msg => {
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
