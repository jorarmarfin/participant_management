<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-application-logo class="block h-12 w-auto" />

                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Bienvenido al sistema de gestión de participantes
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        Sistema diseñado para gestionar de manera eficiente el registro, seguimiento y
                        fidelización de participantes en eventos y campañas organizadas por la plataforma
                        Padres Peruanos. Facilita la administración de adherencias, optimiza la comunicación y
                        fortalece el vínculo con las familias comprometidas con la misión de la plataforma
                    </p>
                    <div class="grid grid-cols-5 gap-4 mt-8">
                        <livewire:dashboard.card-attached-live :count="$count_participants" name="Participantes" />
                        <livewire:dashboard.card-attached-live :count="$count_attached" name="Adheridos" />
                        <livewire:dashboard.card-attached-live :count="$count_new" name="Nuevos (Charla)" />
                        <livewire:dashboard.card-attached-live :count="$count_new_web" name="Nuevos (web)" />
                        <livewire:dashboard.card-attached-live :count="$count_new_campaigns" name="Campañas" />
                    </div>
                    <div>
                        <h2 class="mt-8 text-lg font-medium text-gray-900">Descripción de datos</h2>
                        <ul>
                            <li>Usuarios sin email: {{$count_not_email}}</li>
                            <li>Teléfonos no validos: {{$count_phone_not_valid}}</li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mt-8 text-lg text-gray-900 font-bold">Estadística de participantes adheridos </h2>
                        <livewire:dashboard.card-count-by-ubigeo />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
