<x-modal title="Crear cliente {{ $nombres_cliente }}" id="modalCrearCliente" type="store">

    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">

            @error('nombres_cliente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="nombresCliente">Nombres:</span>
                <input type="text" class="form-control" aria-label="Nombres" aria-describedby="nombresCliente" wire:model.blur="nombres_cliente"
                    value="">
            </div>

            @error('telefono_cliente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="telefonoCliente">Teléfono:</span>
                <input type="text" class="form-control" id="telefonoCliente" aria-describedby="telefonoCliente" wire:model.blur="telefono_cliente"
                    value="">
            </div>

            @error('documento_cliente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="documentoCliente">Documento:</span>
                <input type="text" class="form-control" id="documentoCliente" aria-describedby="documentoCliente" wire:model.blur="documento_cliente"
                    value="">
            </div>

            @error('horas_jugadas_cliente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            @error('horas_regalo_cliente')
                <span class="text-danger er">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <span class="input-group-text text-success" id="horasJugadasCliente">H. Jugadas:</span>
                <input type="email" class="form-control" id="horasJugadasCliente" aria-describedby="horasJugadasCliente" wire:model.blur="horas_jugadas_cliente"
                    value="">
                <span class="input-group-text text-success" id="horasRegaloCliente">H. Regalo:</span>
                <input type="email" class="form-control" id="horasRegaloCliente" aria-describedby="horasRegaloCliente" wire:model.blur="horas_regalo_cliente"
                    value="">
            </div>
        </div>
    </div>
</x-modal>
