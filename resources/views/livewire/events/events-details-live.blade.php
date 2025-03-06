<div>
    <div class="card">
        <div class="card-header flex flex-1 justify-between items-center">
            <h1 class="text-3xl">Cantidad de participantes: {{$total}}</h1>
            <livewire:utils.download-excel-live :event_id="$event_id" />
        </div>

        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Código pp</th>
                    <th>Lista difusión</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Estatus</th>
                    <th>Fecha</th>
                    <th>Ubigeo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->iteration + $participants->firstItem() - 1 }}</td>
                        <td>{{ $participant->code_pp }}</td>
                        <td>{{ $participant->broadcast_list }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->status }}</td>
                        <td>{{ $participant->created_at }}</td>
                        <td>{{ $participant?->ubigeo?->description }}</td>
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
