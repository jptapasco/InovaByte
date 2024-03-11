<x-modal title="Agregar cantidad al inventario" id="modalAgregarCantidad" type="editCantidad">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            <div class="input-group">
                @error('cantidad_agregada')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
            <span class="input-group-text text-success" id="cantidadProducto">Cantidad actual:</span>
            <input type="text" class="form-control" aria-label="Nombres" aria-describedby="cantidadProducto" wire:model="cantidad_producto_actual" disabled>
            
            <span class="input-group-text text-success" id="cantidadAgregada">Agregado:</span>
            <input type="text" class="form-control" aria-label="Nombres" aria-describedby="cantidadAgregada" wire:model="cantidad_agregada">
            
            <div>
                <span class="input-group-text text-success" id="cantidadTotalAgregada">Total:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="cantidadTotalAgregada" wire:model="cantidad_agregada_total" >
            </div>
            

        </div>
    </div>
</x-modal>
