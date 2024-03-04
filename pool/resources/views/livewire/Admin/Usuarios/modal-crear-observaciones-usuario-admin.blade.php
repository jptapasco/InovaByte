<x-modal title="Crear observación para {{ $nombres_usuario }}" id="modalAddDetalles" type="custom" button="Agregar"
    function="addObservacion">
    <div class="card border-success-subtle mb-2">
        <div class="card-body text-success">
            <div class="form-floating">
                <p>Deja la observación aqui:</p>
                <div class="input-group">
                    <textarea wire:model='observacion' class="form-control" id="floatingTextarea"></textarea>
                </div>
            </div>
        </div>
    </div>
</x-modal>