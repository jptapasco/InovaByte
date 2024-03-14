<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Productos</h1>
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
                        <th scope="col">Fecha Registro</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Unidad Medida</th>
                        <th scope="col">Precio Compra</th>
                        <th scope="col">Precio Venta</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Punto Reorden</th>
                        <th scope="col">Editar Productos</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($productos->count() == 0)
                        <tr>
                            <td colspan="6" style="text-align:center">No hay productos</td>
                        </tr>
                    @else
                        @foreach ($productos as $producto)
                            <tr>
                                <td>{{ $producto->created_at->format('Y-m-d') }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->descripcion }}</td>
                                <td>{{ $producto->categoria }}</td>
                                <td>{{ $producto->unidad_medida }}</td>
                                <td>{{ $producto->precio_compra }}</td>
                                <td>{{ $producto->precio_venta }}</td>
                                <td>{{ $producto->cantidad }}</td>
                                <td>{{ $producto->punto_reorden }}</td>
                                <td><button type="button" class="btn btn-success"
                                    wire:click='actualizarIdProducto({{ $producto->id }}, 1)'>Editar</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @include('livewire.Admin.Inventario.modal-editar-producto-admin')
        @include('livewire.Admin.Inventario.modal-crear-producto-admin')
        @include('livewire.Cajero.Inventario.modal-agregar-cantidad')
        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalEditarProducto = new bootstrap.Modal('#modalEditarProducto');
                const modalCrearProducto = new bootstrap.Modal('#modalCrearProducto');
                const modalAgregarCantidad = new bootstrap.Modal('#modalAgregarCantidad');

                @this.on('show-modal-editar-producto', msg => {
                    modalEditarProducto.show();
                });
                @this.on('hide-modal-editar-producto', msg => {
                    modalEditarProducto.hide();
                });

                @this.on('show-modal-crear-producto', msg => {
                    modalCrearProducto.show();
                });
                @this.on('hide-modal-crear-producto', msg => {
                    modalCrearProducto.hide();
                });

                @this.on('show-modal-agregar-cantidad', msg => {
                    modalAgregarCantidad.show();
                });
                @this.on('hide-modal-agregar-cantidad', msg => {
                    modalAgregarCantidad.hide();
                });

            });
        </script>
    </div>
</div>