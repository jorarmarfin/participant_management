<div>

    <div class="card">
        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estatus</th>
                    <th>Ubigeo</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->index +1  }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->status }}</td>
                        <td>{{ $participant?->ubigeo?->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <!-- Controles de paginación -->
        {{ $participants->links() }}
    </div>


</div>
