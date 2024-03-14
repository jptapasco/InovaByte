<div>
    <div class="bg-light card p-5 my-3">
        <h1 id="hora-actual" class="text-center"></h1>
        
        <div class="mt-3">
            <h2>
                Dinero de ventas:
                <span style="color: green;">${{ $detalles_factura->sum('subtotal') }}</span>
            </h2>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <table class="table table-bordered table-success border-success text-center">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">N°</th>
                        <th scope="col">Mesa</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles_factura as $detalle)
                        <tr>
                            <td class="fw-bold"><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($detalle->created_at)->setTimezone('America/Bogota')->locale('es')->isoFormat('h:mm:ss A') }}</td>
                            <td>{{ $facturas_con_mesas[$detalle->id_factura] ?? 'Sin mesa asociada' }}</td>
                            <td>{{ $nombres[$detalle->id_factura] }}</td>
                            <td>{{ $productos_nombres[$detalle->id_producto] ?? 'Producto no encontrado' }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div>
    <script>
        function actualizarHora() {
            var fecha = new Date();
            var dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
            var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
            var dia = dias[fecha.getDay()];
            var diaMes = fecha.getDate();
            var mes = meses[fecha.getMonth()];
            var anio = fecha.getFullYear();
            var horas = fecha.getHours();
            var minutos = fecha.getMinutes();
            var segundos = fecha.getSeconds();
            var ampm = horas >= 12 ? 'pm' : 'am';

            horas = horas % 12;
            horas = horas ? horas : 12;
            minutos = minutos < 10 ? '0' + minutos : minutos;
            segundos = segundos < 10 ? '0' + segundos : segundos;

            var horaString = dia + ' ' + diaMes + ' de ' + mes + ' del año ' + anio + ' ' + horas + ':' + minutos + ':' + segundos + ' ' + ampm;
            document.getElementById('hora-actual').innerHTML = horaString;
            setTimeout(actualizarHora, 1000);
        }
        window.onload = function() {
            actualizarHora();
        };
    </script>
</div>
