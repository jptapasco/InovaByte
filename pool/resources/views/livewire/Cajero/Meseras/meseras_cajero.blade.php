<div>
    <div class="bg-light card p-5 my-3">
        <h1 class="text-success">Meseras</h1>
        <select class="form-select" name="selectOpcion" aria-label="Default select example">
            <option value="todas">Todas</option>
            <option value="disponibles">Disponibles</option>
            <option value="no_alcoholicas">Asignadas</option>
        </select>
        <div class="mt-4">
            <table class="table table-bordered table-success border-success">
                <thead>
                    <tr>
                        <th>Mesera</th>
                        <th>Estado</th>
                        <th>Mesas asignadas</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista_meseras as $mesera)
                        <tr>
                            <td>{{ $mesera->nombres }}</td>
                            <td>{{ $mesera->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>   
    </div>


</div>
