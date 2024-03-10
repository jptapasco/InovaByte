@props(['id', 'funcion'])
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header bg-success text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">¿Está seguro?</h1>
            </div>
            <div class="modal-body bg-success bg-opacity-25">
                <div class="card border-success-subtle mb-2">
                    <div class="card-body text-success">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-success bg-opacity-50">
                <div class="mx-auto">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" wire:click='{{ $funcion }}'>Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>