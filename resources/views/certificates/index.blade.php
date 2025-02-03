<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Lista de Certificados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Certificados Asignados</h3>

                    @if ($certificates->isEmpty())
                        <p class="text-gray-600">No tienes certificados asignados actualmente.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($certificates as $certificate)
                                <div class="border rounded-lg shadow p-4 bg-gray-50 hover:bg-gray-100">
                                    <h4 class="font-semibold text-gray-800">{{ $certificate->title }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        Asignado el: {{ \Carbon\Carbon::parse($certificate->issued_at)->format('d M Y') }}
                                    </p>
                                    <a href="{{ asset($certificate->file_path) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600">
                                        Ver PDF
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
