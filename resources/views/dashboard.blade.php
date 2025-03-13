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
                        Sistema diseñado para gestionar el registro y seguimiento de participantes en eventos organizados por ONGs, instituciones educativas o comunidades. Su objetivo principal es facilitar la fidelización de los asistentes y proporcionar herramientas para un análisis estadístico eficiente.
                    </p>
                    <div class="grid grid-cols-4 gap-4 mt-8">
                        <livewire:dashboard.card-attached-live :count="$count_participants" name="Participantes" />
                        <livewire:dashboard.card-attached-live :count="$count_attached" name="Adherido" />
                        <livewire:dashboard.card-attached-live :count="$count_new" name="Nuevo (Charla)" />
                        <livewire:dashboard.card-attached-live :count="$count_new_web" name="Nuevo (web)" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
