<div>
    <div class="card">
        <div class="card-header flex flex-1 justify-between items-center">
            <h1 class="text-3xl">Cantidad de participantes: {{$participants->count()}}</h1>
            <livewire:utils.download-excel-live :event_id="$event_id" />
        </div>

        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Estatus</th>
                    <th>Acciones</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->status }}</td>
                        <td>
                            <x-primary-button wire:click="contact('{{ $participant->id }}','{{$participant->phone}}')" class="btn btn-primary">Contacto</x-primary-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <!-- Controles de paginación -->
        {{ $participants->links() }}
    </div>

</div>
