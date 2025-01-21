<div>
    <div class="card">
        <div class="card-header">
            <h1 class="text-3xl">Cantidad de participantes: {{$participants->count()}}</h1>
        </div>

        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Acciones</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>
                           acciones
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <!-- Controles de paginación -->
{{--        {{ $participants->links() }}--}}
    </div>

</div>
