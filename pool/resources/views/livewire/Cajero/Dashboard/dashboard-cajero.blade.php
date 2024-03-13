<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Productos</h1>
        <select class="form-select" name="selectCategoria" aria-label="Default select example"
            wire:model="categoriaSeleccionada" wire:change="actualizarProductos">
            <option selected>Elije la categoria</option>
            <option value="alcoholicas">Alcoholicas</option>
            <option value="no_alcoholicas">No alcoholicas</option>
            <option value="comida">Comida</option>
            <option value="snacks">Snacks</option>
        </select>
        <div class="mt-4">
            <div class="row d-flex justify-content-center">
                @forelse ($productos as $producto)
                    <div class="col-md-6 col-lg-3 col-sm-12 mb-4 ">
                        <div class="card border-success-subtle ">
                            <img src="data:image/png;base64,{{ $producto->url }}" alt="Uploaded Image" style="width: 100%; height: 230px;">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-success">{{ $producto->nombre }}</h5>
                                <p class="card-text text-success fw-bold">${{ $producto->precio_venta }}</p>
                                <p class="card-text fw-bold
                                    @if($producto->cantidad > $producto->punto_reorden)
                                        text-success 
                                    @else
                                        text-danger
                                    @endif">
                                    {{ $producto->cantidad }}
                                </p>
                                <button class="btn btn-outline-success" wire:click="agregarProducto({{ $producto->id }})">
                                    <i class="fa-solid fa-cart-shopping"></i> Agregar
                                </button>
                            </div>                                
                        </div>
                    </div>
                @empty
                    <h1 class="text-success">No hay productos</h1>
                @endforelse
            </div>
        </div>

        <!-- Mostrar tabla de productos seleccionados -->
        <h1 class="text-success">Productos seleccionados</h1>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <table class="table table-bordered table-success border-success text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad Disponible</th>
                        <th>Cantidad a llevar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productosSeleccionados as $index => $item)
                        <tr>
                            <td>{{ $item['producto']->nombre }}</td>
                            <td>{{ $item['producto']->precio_venta }}</td>
                            <td>{{ $item['producto']->cantidad }}</td>
                            <td>
                                <div class="input-group">
                                    <button wire:click="disminuirCantidad({{ $index }})" class="btn btn-danger"
                                        type="button">-</button>
                                    <span class="form-control text-center">{{ $item['cantidad_a_llevar'] }}</span>
                                    <button wire:click="aumentarCantidad({{ $index }})" class="btn btn-success"
                                        type="button">+</button>
                                </div>
                            </td>
                            <td>
                                <button wire:click="eliminarFila({{ $index }})" class="btn btn-danger"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($productosSeleccionados)
            <div class="text-center">
                <button wire:click="facturar" class="btn btn-success mb-5 btn-lg"><i class="fa-solid fa-file-invoice-dollar"></i> Facturar</button>
            </div>
        @else
            <div class="text-center">
                <button class="btn btn-success mb-5 disabled btn-lg"><i class="fa-solid fa-file-invoice-dollar"></i> Facturar</button>
            </div>
        @endif
    </div>
</div>