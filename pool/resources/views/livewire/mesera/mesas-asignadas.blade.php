<div>
    <div class="bg-light card p-5 my-3 shadow-lg p-3 mb-5 bg-body rounded">

        <div class="container text-center m-3">
            {{-- TITULO --}}
            <div class="mb-3">
                <h1 class="text-success">Lista de Mesas</h1>
                <hr class="col-6 mx-auto">
            </div>

            {{-- BOTONES PARA FILTRAR MESAS --}}
            <div class="row mt-5">
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="obtenerMesas">Todas</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="mesasLibres">Disponibles</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-success px-5" wire:click="mesasOcupadas">Ocupadas</button>
                </div>
            </div>
        </div>

        {{-- TARJETAS PARA MESAS --}}
        <div class="mt-5">
            <div class="row d-flex justify-content-center text-center">

                @forelse ($mesas as $mesa)
                    <div class="col-md-6 col-lg-3 col-sm-12 mb-4">
                        <div class="card border-success-subtle text-end">

                            {{-- Imagen billar --}}
                            <div class="position-relative">
                                <img class="position-absolute" src="{{ asset('img/mesa-de-billar(2).png') }}" alt="">
                            </div>
                            <h4 class="text-center text-success">Mesa</h4>
                            <hr class="m-2">
                            <div class="card-body">
                                <h5 class="card-text text-success">Mesa No: <span class="text-black">{{ $mesa->numero }}</span></h5>
                                <p class="card-text text-success">Tipo: <span class="text-black">{{ $mesa->tipoMesa->nombre_mesa }}</span></p>
                                <p class="card-text text-success">Estado: <span>{{ $mesa->id_cliente_asignado != null ? 'Ocupada':'Libre'}}</span></p>

                                @if ($mesa->id_cliente_asignado == null)
                                    <button class="btn btn-outline-secondary" wire:click="iniciarMesa('{{ $mesa->id }}')">Iniciar</button>
                                @else
                                <button class="btn btn-outline-secondary" wire:click="abrirFacturaMesa({{ $mesa->id }})"><i class="fa-solid fa-eye"></i></button>
                                    <button class="btn btn-outline-secondary" wire:click="abrirChiste({{ $mesa->id }})"><i class="fa-solid fa-cart-plus"></i></button>
                                    <button class="btn btn-outline-secondary" wire:click="cerrarMesa({{ $mesa->id }})">Cobrar</button>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                    <h2 class="text-warning">No tienes mesas asignadas.</h2>
                @endforelse
            </div>
        </div>

        {{-- MODALES DE LAS TARJETAS --}}
        @include('components.mesera.modal-abrir-mesa')
        @include('livewire.Mesera.modal-chistoso-producto')
        @include('livewire.Mesera.modal-factura-mesa')

        {{-- @include('livewire.mesera.mesas-asignadas') --}}

        {{-- EVENTOS PARA MODALES --}}
        <script>
            document.addEventListener('livewire:initialized', function() {
                const modalAbrirMesa = new bootstrap.Modal('#modalAbrirMesa');
                const modalChistoso = new bootstrap.Modal('#modalChistoso');
                const modalFacturaMesa = new bootstrap.Modal('#modalFacturaMesa');

                @this.on('show-start-modal', msg => {
                    modalAbrirMesa.show();
                });
                @this.on('close-start-modal', msg=> {
                    modalAbrirMesa.hide();
                })

                @this.on('show-modal-chistoso', msg => {
                    modalChistoso.show();
                });
                @this.on('close-modal-chistoso', msg=> {
                    modalChistoso.hide();
                })

                @this.on('show-modal-factura-mesa', msg => {
                    modalFacturaMesa.show();
                });
                @this.on('close-modal-factura-mesa', msg=> {
                    modalFacturaMesa.hide();
                })

            });
        </script>
    </div>
</div>
