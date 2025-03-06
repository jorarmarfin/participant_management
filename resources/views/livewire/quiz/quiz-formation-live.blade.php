<div class="min-h-screen flex items-center justify-center bg-red-700 py-6 ">
    <div class="bg-white  rounded-lg shadow-lg pb-10 w-10/12 md:w-1/2">
        <div class="mb-6 text-center">
            <img src="{{$imagen}}" alt="Cabecera" class="rounded-t-lg  mb-4" >
            <h2 class="text-2xl font-bold text-gray-700">Registro de Usuario</h2>
        </div>
        @if($submitted)
            <div class="text-center text-3xl">
                Gracias por llenar el formulario <br>
                {{$start_date}}
            </div>
        @else
            <form wire:submit="save" class="space-y-6 px-4">
                @csrf
                <!-- Campo Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                    <input type="email" id="email" name="email" wire:model.blur="form.email"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ingresa tu correo electrónico" required>
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
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ingresa tus nombres" required>
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
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ingresa tus apellidos" required>
                    @error('form.last_name')
                        <div class="bg-red-300 rounded p-2 m-2">
                            <span class="font-bold">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Campo Ubigeo -->
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

                    @if($form->country == 'Perú')
                        <label for="departamento" class="block text-gray-700 font-medium mb-2">¿Donde vives? Dpto./Prov./Distrito</label>
                        <div class="mt-2">
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
                        <div class="mt-2">
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
                                @foreach($distritos as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('distrito')
                        <div class="bg-red-300 rounded p-2 m-2">
                            <span class="font-bold">{{ $message }}</span>
                        </div>
                        @enderror
                    @endif


                </div>

                <!-- Campo Teléfono -->
                <div x-data x-init="Inputmask({'mask': '999-999-999'}).mask($refs.phoneInput)">
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Teléfono celular</label>
                    <input type="text" id="phone" wire:model.defer="form.phone" x-ref="phoneInput"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="000-000-000" required>
                    @error('form.phone')
                        <div class="bg-red-300 rounded p-2 m-2">
                            <span class="font-bold">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <!-- Botón Enviar -->
                <div class="text-center">
                    <button type="submit"
                            class="bg-red-800 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                        Registrar
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
