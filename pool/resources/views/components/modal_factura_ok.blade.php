@props([
    'size' => '', // Tamaño del modal
    'id', // ID del modal
    'type' => '', // Tipo de modal
    'button' => '', // Nombre del botón personalizado
    'function' => '', // Función que ejecutará el botón personalizado
    'icon' => '', //Icono central
    'iconColor' => '', //Color Icono
])

<div class="modal fade {{ $size ? ($size == 'fullscreen' ? '' : 'modal-' . $size) : '' }}" id="{{ $id }}"
    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
    wire:ignore.self>
    <div class="modal-dialog {{ $size == 'fullscreen' ? 'modal-fullscreen' : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="resetUI"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mb-4">
                    <i class="{{ $icon }} fa-10x text-center" style="{{ $iconColor }}"></i>
                </div>
                <div style=width:100%>
                    <h2 class="fs-25 text-center">{{ $title }}</h2>
                    <h2 class="fs-20 text-center">{{ $slot }}</h2>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                @if ($type == 'confirmar')
                    <x-buttons.primary-button class='btn-lg' color="success" 
                        wire:click="{{ $function }}">
                        {{$button}}
                    </x-buttons.primary-button>
                @else @if ($type == 'eliminar')
                    <x-buttons.primary-button class='btn-lg' color="danger" 
                        wire:click="{{ $function }}">
                        {{$button}}
                    </x-buttons.primary-button>
                @endif
                    
                @endif
                <x-buttons.primary-button class='btn-lg' color='light' data-bs-dismiss="modal" wire:click="resetUI">
                    Cancelar
                </x-buttons.primary-button>
            </div>
        </div>
    </div>
</div>