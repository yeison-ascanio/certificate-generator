<x-app-layout>
<div class="container mx-auto p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Título -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Validación de Certificado</h1>
        </div>

        <!-- Mensaje de estado -->
        @if ($status === 'error')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-8" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ $message }}</span>
        </div>
        @else
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8" role="alert">
            <strong class="font-bold">Éxito:</strong>
            <span class="block sm:inline">{{ $message }}</span>
        </div>

        <!-- Información del certificado -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Información del Certificado</h2>
            <ul class="divide-y divide-gray-200">
                <li class="py-2">
                    <strong class="text-gray-600">Estudiante:</strong>
                    <span class="text-gray-800">{{ $data['student'] }}</span>
                </li>
                <li class="py-2">
                    <strong class="text-gray-600">Título:</strong>
                    <span class="text-gray-800">{{ $data['title'] }}</span>
                </li>
                <li class="py-2">
                    <strong class="text-gray-600">Emitido el:</strong>
                    <span class="text-gray-800">{{ \Carbon\Carbon::parse($data['issued_at'])->format('d M Y') }}</span>
                </li>
                <li class="py-2">
                    <strong class="text-gray-600">Hash de Seguridad:</strong>
                    <span class="text-gray-800">{{ $data['hash'] }}</span>
                </li>
            </ul>
        </div>
        @endif

        <!-- Botón para regresar -->
        <div class="mt-6 text-center">
            <a href="{{ route('dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow">
                Volver al inicio
            </a>
        </div>
    </div>
</div>
</x-app-layout>
