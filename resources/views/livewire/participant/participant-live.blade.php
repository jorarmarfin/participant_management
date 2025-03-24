<div>
    <div class="card">
        <div class="flex flex-1 justify-end">
            <button
                wire:click="downLoadFile('PE')"
                class="btn-success">
                <i class="fas fa-file-excel"></i>
            </button>
            <button
                wire:click="downLoadFile('WP')"
                class="btn-success ms-2">
                <i class="fab fa-whatsapp"></i>
            </button>
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <label class="font-bold">Estatus de personas</label>
                <select
                    wire:model.live="currentStatus"
                    class="form-select">
                    <option value="0">Seleccione</option>
                    @foreach($status as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-bold">Buscar</label>
                <input
                    wire:model.live="search"
                    type="text"
                    class="input-text"
                    placeholder="Buscar por nombres o teléfonos" />

            </div>
            <div>
                <label class="font-bold">Filtro</label>
                <select
                    wire:model.live="notSwitch"
                    class="form-select">
                    <option value="0">Seleccione</option>
                    <option value=1>Personas sin teléfonos</option>
                    <option value=2>Personas sin email</option>
                    <option value=3>Personas sin teléfono y sin email</option>
                </select>
            </div>
        </div>
        <div wire:loading wire:target="search" class="text-center py-4">
            <p class="text-gray-500">Buscando...</p>
        </div>

        <div wire:loading.remove class="mt-4 overflow-x-auto" >
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Código pp</th>
                    <th>Lista difusión</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estatus</th>
                    <th>Pais</th>
                    <th>Ubigeo</th>
                    <th>Accion</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $participant->code_pp }}</td>
                        <td>{{ $participant->broadcast_list }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->status }}</td>
                        <td>{{ $participant->country }}</td>
                        <td>{{ $participant?->ubigeo }}</td>
                        <td class="flex">
                            <button wire:click="contact('{{ $participant->id }}','{{ $participant->phone }}')"
                                    type="button"
                                    class="btn-icon-success">
                                <i class="far fa-address-book"></i>
                            </button>
                            <a href="/participants/{{$participant->id}}/edit" class="btn-icon-primary">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button wire:click="delete({{ $participant->id }})" class="btn-icon-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Controles de paginación -->
            {{ $participants->links() }}
        </div>
    </div>

</div>
@script
<script>
    $wire.on('alert', (data) => {
        const swa = data[0];
        Swal.fire({
            title: swa.title,
            text: swa.message,
            icon: swa.icon,
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endscript
