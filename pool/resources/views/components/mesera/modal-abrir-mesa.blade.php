<x-modal title="Abrir mesa: {{ $mesa_db ? $mesa_db->numero : '' }}" id="modalAbrirMesa" type="custom" button="Agregar" function="asignarMesa({{ $mesa_db ? $mesa_db->id : '' }})">
    <div class="input-group mb-3">
        <label class="input-group-text text-success" for="cliente">Seleccione el cliente:</label>
        <select class="form-select" id="cliente" wire:model.live="asignar_cliente">
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombres }}</option>

            @endforeach
        </select>

    </div>
</x-modal>
