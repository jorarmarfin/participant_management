<div>
    <form wire:submit="updateForm" class="space-y-6 p-4 grid gap-4
    grid-cols-1
    md:grid-cols-2
    sm:grid-cols-4
    ">
        @csrf
        <!-- Campo code_pp -->
        <div>
            <label for="code_pp" class="block text-gray-700 font-medium mb-2">Código de Participante</label>
            <input type="text" id="code_pp" name="code_pp" wire:model="form.code_pp"
                   class="input-text"
                   placeholder="Ingresa tu código de participante">
            @error('form.code_pp')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Campo broadcast_list -->
        <div>
            <label for="broadcast_list" class="block text-gray-700 font-medium mb-2">Lista de Difusión</label>
            <input type="text" id="broadcast_list" name="broadcast_list" wire:model="form.broadcast_list"
                   class="input-text"
                   placeholder="Ingresa tu lista de difusión">
            @error('form.broadcast_list')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Campo Email -->
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
            <input type="email" id="email" name="email" wire:model="form.email"
                   class="input-text"
                   placeholder="Ingresa tu correo electrónico">
            @error('form.email')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>
        <!-- Campo Nombres -->
        <div>
            <label for="nombres" class="block text-gray-700 font-medium mb-2">Nombres</label>
            <input type="text" id="nombres" name="nombres" wire:model="form.names"
                   class="input-text"
                   placeholder="Ingresa tus nombres">
            @error('form.names')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror

        </div>

        <!-- Campo Apellidos -->
        <div>
            <label for="apellidos" class="block text-gray-700 font-medium mb-2">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" wire:model="form.last_name"
                   class="input-text"
                   placeholder="Ingresa tus apellidos">
            @error('form.last_name')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Campo Teléfono -->
        <div >
            <label for="phone" class="block text-gray-700 font-medium mb-2">Teléfono celular</label>
            <input type="text" id="phone" wire:model.defer="form.phone" x-ref="phoneInput"
                   class="input-text"
                   placeholder="000-000-000">
            @error('form.phone')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Campo Colegio -->
        <div>
            <label for="type" class="block text-gray-700 font-medium mb-2">Tipo de Institución Educativa de sus hijos</label>
            <select wire:model="form.educational_institution_type" id="type" name="type"
                    class="input-text"
                    >
                <option value="">Seleccionar Tipo de Institución Educativa</option>
                @foreach($types as $type)
                    <option value="{{$type}}">{{$type}}</option>
                @endforeach
            </select>
            @error('form.educational_institution_type')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Campo Pais -->
        <div>
            <label for="pais" class="block text-gray-700 font-medium mb-2">País </label>
            <div class="mt-2">
                <select wire:model.live="form.country" class="form-select" name="pais" id="pais">
                    <option value="">Seleccionar País</option>
                    @foreach($countries as $country)
                        <option value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Campo Ubigeo -->
        <div>

            <label for="apellidos" class="block text-gray-700 font-medium mb-2">¿Donde vives? Dpto./Prov./Distrito</label>
            <div class=" mt-2">
                <select wire:model.live="departamento" class="form-select" name="departamento" id="departamento">
                    <option value="">Seleccionar Departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{$departamento}}">{{$departamento}}</option>
                    @endforeach
                </select>
                @error('departamento')
                <div class="bg-red-300 rounded p-2 m-2">
                    <span class="font-bold">{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class=" mt-2">
                <select wire:model.live="provincia" class="form-select" name="provincia" id="provincia">
                    <option value="">Seleccionar Provincia</option>
                    @foreach($provincias as $provincia)
                        <option value="{{$provincia}}">{{$provincia}}</option>
                    @endforeach
                </select>
                @error('provincia')
                <div class="bg-red-300 rounded p-2 m-2">
                    <span class="font-bold">{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class=" mt-2">
                <select wire:model.live="distrito" class="form-select" name="distrito" id="distrito">
                    <option value="">Seleccionar Distrito</option>
                    @foreach($distritos as $distrito)
                        <option value="{{$distrito->id}}">{{$distrito->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('distrito')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>
        <div>
            <label for="observation" class="block text-gray-700 font-medium mb-2">Observaciones</label>
            <textarea id="observation" name="observation" wire:model="form.observation"
                      class="input-textarea"
                      placeholder="Ingresa tus observaciones"></textarea>
            @error('form.observation')
            <div class="bg-red-300 rounded p-2 m-2">
                <span class="font-bold">{{ $message }}</span>
            </div>
            @enderror
        </div>

        <!-- Botón Enviar -->
        <div class="text-center">
            <button type="submit"
                    class="w-full bg-red-800 text-white font-semibold px-6 py-2 rounded-lg shadow-md
                    hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                Actualizar
            </button>
        </div>
    </form>
</div>
