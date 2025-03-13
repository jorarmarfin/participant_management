<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bienvenido al sistema de gestión de participantes
    </h1>

    <p class="mt-6 text-gray-500 leading-relaxed">
        Sistema diseñado para gestionar el registro y seguimiento de participantes en eventos organizados por ONGs, instituciones educativas o comunidades. Su objetivo principal es facilitar la fidelización de los asistentes y proporcionar herramientas para un análisis estadístico eficiente.
    </p>
    <div class="grid grid-cols-5 gap-4 mt-8">
        <livewire:dashboard.card-attached-live :status="$count_attached" />
    </div>
</div>


