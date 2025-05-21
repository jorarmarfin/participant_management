<div>
    <div class="card">
        <div class="flex justify-between">
            <div>
                <input type="file" wire:model="file" class="form-control" />
                @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                <button wire:click="uploadFile" wire:loading.attr="disabled" wire:target="uploadFile"
                    type="button" class="btn-primary">Cargar archivo</button>
                <a href="{{asset('assets/example.xlsx')}}" target="_blank" type="button" class="btn-primary" download>
                    <i class="fas fa-file-excel"></i>
                </a>
            </div>
            <div>
                <button
                    wire:click="downLoadFile('PE')"
                    class="btn-success">Descargar
                    <i class="fas fa-file-excel"></i>
                </button>
                <button
                    wire:click="downLoadFile('WP')"
                    class="btn-success ms-2">Descargar
                    <i class="fab fa-whatsapp"></i>
                </button>
            </div>


        </div>

        <div class="grid grid-cols-6 gap-4 mt-10">
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
                    <option value=5>Personas sin ubigeo</option>
                    <option value=4>Ordenar fecha decreciente</option>
                </select>
            </div>
            <div>
                <label class="font-bold">Departamentos</label>
                <select wire:model.live="departament"  class="form-select">
                    <option value="0">Seleccione</option>
                    @foreach($departamentos as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-bold">Provincias</label>
                <select wire:model.live="provincia"  class="form-select">
                    <option value="0">Seleccione</option>
                    @foreach($provincias as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-bold">Distritos</label>
                <select wire:model.live="distrito"  class="form-select">
                    <option value="0">Seleccione</option>
                    @foreach($distritos as $key => $value)
                        <option value="{{ $value->name }}">{{ $value->name }}</option>
                    @endforeach
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
                    <th>N°</th>
                    <th>Código pp</th>
                    <th>Lista difusión</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estatus</th>
                    <th>Pais</th>
                    <th>Ubigeo</th>
                    <th>Fecha</th>
                    <th>Acción</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($participants as $participant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $participant->code_pp }}</td>
                        <td>{{ $participant->broadcast_list }}</td>
                        <td>{{ $participant->last_name }}</td>
                        <td>{{ $participant->names }}</td>
                        <td>{{ $participant->email }}</td>
                        <td>{{ $participant->phone }}</td>
                        <td>{{ $participant->status }}</td>
                        <td>{{ $participant->country }}</td>
                        <td>{{ $participant?->ubigeo }}</td>
                        <td>{{ $participant->created_at }}</td>
                        <td class="flex">
                            <button wire:click="setStatus('{{ $participant->id }}')"
                                    type="button"
                                    class="btn-icon-primary">
                                A
                            </button>
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
