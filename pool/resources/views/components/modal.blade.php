@props([
    'title', //titulo del modal
    'size' => '',
    /*Tamaño del modal, opciones 
    [nombre => tamaño maximo]: 
    [ NULL => 500px]
    [sm => 300px],
    [lg => 800px],
    [xl => 1140],
    [fullscreen => Tamaño de la pantalla],
    */
    'type' =>
        '' /* Tipo de modal, opciones
    [nombre => accion]:
    [NULL => no tiene boton de confirmacion],
    [store => boton 'guardar', ejecuta la funcion 'store' del controlador],
    [edit => boton 'actualizar', ejecuta la funcion 'update' del controlador ]
    [custom => requiere las propiedades 'button', 'function': button será el nombre del boton
                y function la funcion que ejecutará
    ]
    */,
    'button' => '', //Nombre del boton personalizado
    'function' => '', //Funcion que ejecutara el boton personalizado
    'id',
])

<div class="modal fade {{ $size ? ($size == 'fullscreen' ? '' : 'modal-' . $size) : '' }}" id={{$id}} tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-keyboard="false" wire:ignore.self>
    <div class="modal-dialog {{ $size == 'fullscreen' ? 'modal-fullscreen' : '' }}">
        <div class="modal-content">
            <div class="modal-header bg-success text-light">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
            </div>
            <div class="modal-body bg-success bg-opacity-25">
                {{ $slot }}
            </div>
            <div class="modal-footer bg-success bg-opacity-50">
                <div class="mx-auto">
                    <x-primary-button color='success' data-bs-dismiss="modal" wire:click='resetUI'>
                        Cerrar
                    </x-primary-button>
                    @if ($type == 'store')
                    <x-primary-button iconL='fa-solid fa-floppy-disk' wire:click='store'>
                        Guardar
                    </x-primary-button>
                    @elseif ($type == 'edit')
                    <x-primary-button iconL='fa-solid fa-rotate' wire:click='update'>
                        Actualizar
                    </x-primary-button>
                    @elseif ($type == 'custom')
                    <x-primary-button wire:click='{{$function}}'>
                        {{$button}}
                    </x-primary-button>
                    @elseif ($type == 'editCantidad')
                    <x-primary-button iconL='fa-solid fa-rotate' wire:click='updateCantidad'>
                        Actualizar
                    </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>