<div>
    <div class="bg-light card p-5 my-3">
        <h1 id="hora-actual" class="text-center"></h1>
        <div class="mt-3">
            <h2>
                Dinero de ventas:
                @php
                    $sumatoria_total = collect($id_factura)->pluck('total')->sum();
                @endphp

                <span style="color: green;">${{ $sumatoria_total }}</span>
            </h2>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-5">
            <table class="table table-bordered table-success border-success text-center">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">N°</th>
                        <th scope="col">Mesas</th>
                        <th scope="col">Factura</th>
                        <th scope="col">Total</th>
                        <th scope="col">Opcion</th>
                    </tr>
                </thead>
                @if(empty($id_factura))
                    <tr>
                        <td colspan="6">No hay facturas realizadas</td>
                    </tr>
                @else
                @foreach($nombres as $key => $nombre)
                    <tr>
                        @if(array_key_exists($key, $id_factura))
                            <td>{{ $id_factura[$key]['hora_inicio'] }}</td>
                            <td>{{ $mesas[$key]->numero }}</td>
                            <td>{{ $nombre }}</td>
                            <td>{{ $id_factura[$key]['id'] }}</td>
                            <td>{{ $id_factura[$key]['total'] }}</td>
                            <td><button class="btn btn-success" wire:click='cargarDetalleFactura({{ $id_factura[$key]['id'] }})'>Detalles</button></td>
                        @endif
                    </tr>
                @endforeach
          
                @endif
                <tbody>
                </tbody>                
            </table>
        </div>
    </div>
    @include('livewire.mesera.modal-detalle-factura')
    <script>
        document.addEventListener('livewire:initialized', function() {
            const modalDetalleFactura = new bootstrap.Modal('#modalDetalleFactura');

            @this.on('show-modal', msg => {
                modalDetalleFactura.show();
            });
            @this.on('show-modal-add-obs', msg => {
                modalDetalleFactura.hide();
            });
            @this.on('close-modal-add-obs', msg => {
                modalDetalleFactura.show();
            });

        });
    </script>
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
