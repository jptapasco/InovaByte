<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-center">Hoy es {{ \Carbon\Carbon::now()->locale('es')->isoFormat('dddd D [de] MMMM [del año] YYYY') }}</h1>
        <div class="mt-3">
            <h2>
                Dinero de ventas:
                <span style="color: green;">${{ $detalles_factura->sum('subtotal') }}</span>
            </h2>
            <h2>
                Dinero en caja:
                <span style="color: green;">
                    ${{ 
                        $detalles_factura->filter(function($detalle) use ($facturas_con_mesas) {
                            return isset($facturas_con_mesas[$detalle->id_factura]) && $facturas_con_mesas[$detalle->id_factura] == 'caja';
                        })->sum('subtotal') 
                    }}
                </span>
            </h2>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <table class="table table-bordered table-success border-success text-center">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Mesas</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles_factura as $detalle)
                        <tr>
                            <td>{{ $detalle->created_at }}</td>
                            <td>{{ $facturas_con_mesas[$detalle->id_factura] ?? 'Sin mesa asociada' }}</td>
                            <td>{{ App\Models\Productos::find($detalle->id_producto)->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
