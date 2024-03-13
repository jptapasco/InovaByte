<div>
    <div class="bg-light card p-5 my-3 shadow-lg p-3 mb-5 bg-body rounded">
        <div class="container text-center m-3">
            <div class="mb-3">
                <h1 class="text-success">Lista de Mesas</h1>
                <hr class="col-6 mx-auto">
            </div>            
            <div class="row mt-5">
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="obtenerMesas()">Todas</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="obtenerMesasDisponibles()">Disponibles</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="obtenerMesasOcupadas()">Ocupadas</button>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="row d-flex justify-content-center text-center">
                @forelse ($mesas as $mesa)
                <div class="col-md-6 col-lg-3 col-sm-12 mb-4">
                    <div class="card border-success-subtle text-end">
                        <div class="position-relative">
                            <img class="position-absolute" src="{{ asset('img/mesa-de-billar(2).png') }}" alt="">
                        </div>
                        <h4 class="text-center text-success">Mesa</h4>
                        <hr class="m-2">
                        <div class="card-body">
                            <h5 class="card-text text-success">Tipo de mesa: <span class="text-black">{{ optional($mesa->tipoMesa)->nombre_mesa }}</span></h5>
                            <p class="card-text text-success">Estado: <span style="color: {{ $mesa->estado() == 'Ocupada' ? '#EE4266':'#16FF00' }}">{{ $mesa->estado()}}</span></p>
                            <p class="card-text text-success">Mesera: <span class="text-black">{{ optional($mesa->mesera)->nombres }}</span></p>
                            <div class="card-select">
                                <select class="form-select my-3" name="selectMesera" aria-label="Default select example" wire:model="meserasSeleccionadas.{{ $mesa->id }}">
                                    <option selected>{{ $mesa->optionAsignarMesera() }}</option>
                                    @foreach($meseras as $mesera)
                                        <option value="{{ $mesera->id }}">{{ $mesera->nombres }}</option>
                                    @endforeach
                                </select>   
                            </div>                            
                            @if ($mesa->id_mesera_asignada === null)
                                <button class="btn btn-outline-secondary" wire:click="asignarMesera({{ $mesa->id }})">Asignar</button>
                            @else
                                <div class="d-flex">
                                    <div class="col">
                                        <button class="btn btn-outline-warning" wire:click="asignarMesera({{ $mesa->id }})">Cambiar</button>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-outline-info" wire:click="habilitarMesa({{ $mesa->id }})">Habilitar</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty 
                    <h2 class="text-warning border-bottom border-danger"  style="width: 400px">No hay mesas disponibles.</h2>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', function() {
        const modalConfirmarAsignacion = new bootstrap.Modal('#modalConfirmarAsignacion');
        const modalConfirmarCambioMesera = new bootstrap.Modal('#modalConfirmarCambioMesera');

        @this.on('show-modal-asignar-mesera', msg => {
            modalConfirmarAsignacion.show();
        });
        @this.on('hide-modal-asignar-mesera', msg => {
            modalConfirmarAsignacion.hide();
        });
        
        @this.on('show-modal-cambiar-mesera', msg => {
            modalConfirmarCambioMesera.show();
        });
        @this.on('hide-modal-cambiar-mesera', msg => {
            modalConfirmarCambioMesera.hide();
        });
    });
</script>