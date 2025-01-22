<div>
    <div class="card">
        <div class="card-header">
            <x-primary-button x-on:click="$wire.set('openModal',true)">
                Crear evento
            </x-primary-button>
        </div>
        <div class="mt-4">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Imagen</th>
                    <th>Enlace</th>
                    <th>Acciones</th>


                </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $event->name }}</td>
                        <td>
                            <img src="{{ $event->imagen }}" alt="{{ $event->name }}" class="w-20 h-20">
                        </td>
                        <td>
                            <a href="{{ route('form.web', [$event->type,$event->id]) }}" target="_blank" class=" underline text-blue-700 ">
                                Ver formulario
                            </a>
                        </td>
                        <td>
                            <a class=" inline-flex items-center px-4 py-2 bg-green-600 border rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 " href="{{route('events.details',$event->id)}}">
                                Participantes
                            </a>
                            <x-primary-button wire:click="edit('{{ $event->id }}')">
                                Editar
                            </x-primary-button>
                            <x-danger-button wire:click="delete('{{ $event->id }}')">
                                Eliminar
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <!-- Controles de paginación -->
        {{ $events->links() }}
    </div>

<x-dialog-modal wire:model="openModal">
    <x-slot name="title">
        Crear Evento
    </x-slot>

    <x-slot name="content">

        <div class="mt-4">
            <div>
                <x-label for="names" value="{{ __('Nombres') }}" />
                <x-input id="names" class="block mt-1 w-full" type="text" wire:model="name" required autofocus />
                <x-input-error for="names" class="mt-2" />
            </div>
            <div>
                <x-label for="imagen" value="{{ __('Imagen') }}" />
                <x-input id="imagen" class="block mt-1 w-full" type="text" wire:model="imagen" required autofocus />
                <x-input-error for="imagen" class="mt-2" />
            </div>
            <div>
                <x-label for="date" value="{{ __('Fecha') }}" />
                <x-input id="date" class="block mt-1 w-full" type="date" wire:model="start_date" required autofocus />
                <x-input-error for="date" class="mt-2" />
            </div>
            <div>
                <x-label for="typeForm" value="{{ __('Type Form') }}" />
                <select id="typeForm" wire:model="type" class="block mt-1 w-full">
                    <option value="">Seleccione un tipo</option>
                    @foreach($typeForm as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error for="typeForm" class="mt-2" />
            </div>

        </div>
    </x-slot>

    <x-slot name="footer">
        @if($isEdit)
            <x-primary-button wire:click="update"  wire:loading.attr="disabled">
                Actualizar
            </x-primary-button>
        @else
            <x-primary-button wire:click="store"  wire:loading.attr="disabled">
                Guardar
            </x-primary-button>
        @endif

        <x-secondary-button class="ml-2" wire:click="cancel" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>

<x-dialog-modal wire:model="openModalDelete">
    <x-slot name="title">
        Eliminar Evento
    </x-slot>

    <x-slot name="content">
        <p>¿Estás seguro de eliminar el evento <span class="font-bold">{{$this->name}}</span> ?, esta acción no se puede deshacer.</p>
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="destroy('{{$this->id}}')" wire:loading.attr="disabled">
            Eliminar
        </x-danger-button>

        <x-secondary-button class="ml-2" wire:click="cancel" wire:loading.attr="disabled">
            Cancelar
        </x-secondary-button>
    </x-slot>
</x-dialog-modal>
</div>
