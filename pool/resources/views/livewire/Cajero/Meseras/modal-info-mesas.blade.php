<div class="modal fade" id="modalMesasMesera" function="abrirModalMesasMesera" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Mesas Asignadas a {{ $nombres_mesera }}</h1>
            </div>
            <div class="modal-body bg-success bg-opacity-25">
                <div class="card-body bg-white" style="border-radius: 5px;">
                    <table class="table table-bordered table-success border-success text-center">
                        <thead>
                            <tr>
                                <th>Mesa</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($id_tipo_mesas && $nombres_mesas)
                                @foreach($id_tipo_mesas as $index => $id_tipo_mesa)
                                    <tr>
                                        <td>{{ $id_tipo_mesa }}</td>
                                        <td>{{ $nombres_mesas[$index] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>                                                              
                    </table>                    
                </div>                
            </div>            
            <div class="modal-footer bg-success bg-opacity-50">
                <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
