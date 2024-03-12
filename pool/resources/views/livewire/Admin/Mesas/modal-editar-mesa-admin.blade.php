<x-modal title="Editar mesa {{ $numero_mesa }}" id="modalEditarMesa" type="edit">
    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">
            @error('tipo_mesa')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <label class="input-group-text text-success" for="tipoMesa">Rol:</label>
                <select class="form-select" id="tipoMesa" wire:model.live="tipo_mesa">
                    <option value="0">Seleccionar...</option>
                    <option value="1">Pool</option>
                    <option value="2">Tres Bandas</option>
                    <option value="3">Mesa</option>
                </select>
            </div>

            @error('numero_mesa')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="numeroMesa">Numero Mesa:</span>
                <input type="text" class="form-control" aria-label="Numero" aria-describedby="numeroMesa"
                    wire:model.blur="numero_mesa">
            </div>
        </div>
    </div>
</x-modal>
