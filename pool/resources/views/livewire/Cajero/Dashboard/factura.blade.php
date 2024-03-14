<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Detalles del pedido</h1>
        <div class="mt-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad a Llevar</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @if (!$productosSeleccionados)
                        <tr>
                            <td colspan="4" class="text-center">No hay productos</td>
                        </tr>
                    @else
                        @foreach ($productosSeleccionados as $index => $item)
                            @php
                                $subtotal = $item['producto']->precio_venta * $item['cantidad_a_llevar'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item['producto']->nombre }}</td>
                                <td>{{ $item['producto']->precio_venta }}</td>
                                <td>{{ $item['cantidad_a_llevar'] }}</td>
                                <td>{{ $subtotal }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <h2>Total: ${{ $total }}</h2>
            @if ($vueltoCalculado !== null)
                <h2 class="text-success">Vuelto: {{ $vueltoCalculado }}</h2>
            @endif
        </div>


        <div class="input-group mt-5">
            <span class="input-group-text">Dinero recibido</span>
            <input type="number" wire:model="dineroRecibido" aria-label="Dinero recibido" class="form-control"
                placeholder="$">
        </div>
        <button wire:click="calcularVuelto" class="btn btn-primary mt-3"><i class="fa-solid fa-money-bill"></i>     Calcular Vuelto</button>
        @if ($dineroRecibido < $total && $dineroRecibido !== null)
            <p class="text-danger mt-2">El dinero recibido es menor que el total.</p>
        @elseif($vueltoCalculado !== null)
            <p class="text-success mt-2">Vuelto calculado correctamente.</p>
        @endif
        <div class="text-center mt-5">
            <button id="confirmarButton" wire:click="generarFactura" class="btn btn-success btn-lg mx-3"
                style="width: 200px;"><i class="fa-regular fa-circle-check"></i> Confirmar</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('confirmarButton').addEventListener('click', function() {
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Factura creada Exitosamente",
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "{{ route('resumen') }}";
            });
        });
    </script>
</div>