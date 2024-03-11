<x-modal title="Crear producto nuevo" id="modalAgregarInventario" type="store">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            @error('nombre_producto')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="nombresProducto">Nombre:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="nombresProducto" wire:model.blur="nombre_producto"
                    value="">
            </div>

            @error('descripcion_producto')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="descripcionProducto">Descripción:</span>
                <textarea class="form-control" id="descripcionProducto" aria-describedby="descripcionProducto"  wire:model.blur="descripcion_producto"
                    value=""></textarea>
            </div>

            <div class="input-group">
                @error('categoria_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                @error('unidad_medida_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text text-success" for="categoriaProducto">Categoría:</label>
                <select class="form-select" id="categoriaProducto" wire:model.live="categoria_producto">
                    <option value="0">Seleccione...</option>
                    <option value="alcoholicas">Alcoholicas</option>
                    <option value="no_alcoholicas">No Alcoholicas</option>
                    <option value="comida">Comida</option>
                    <option value="snacks">Snacks</option>
                </select>

                <label class="input-group-text text-success" for="unidadMedidaProducto">U.M:</label>
                <select class="form-select" id="unidadMedidaProducto" wire:model.live="unidad_medida_producto">
                    <option value="0">Seleccione...</option>
                    <option value="unidad">Unidad</option>
                    <option value="paquete">Paquete</option>
                    <option value="canasta">Canasta</option>
                </select>
            </div>

            <div class="input-group">
                @error('precio_compra_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                @error('precio_venta_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="precioCompraProducto">P.C:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="precioCompraProducto" wire:model.blur="precio_compra_producto"
                    value="">

                <span class="input-group-text text-success" id="precioVentaProducto">P.V:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="precioVentaProducto" wire:model.blur="precio_venta_producto"
                    value="">
            </div>

            <div class="input-group">
                @error('cantidad_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                @error('punto_reorden_producto')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="cantidadProducto">Cantidad:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="cantidadProducto" wire:model.blur="cantidad_producto"
                value="">
                
                <span class="input-group-text text-success" id="puntoReordenProducto">P.R:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="puntoReordenProducto" wire:model.blur="punto_reorden_producto"
                    value="">
            </div>

        </div>
    </div>
</x-modal>
