<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Generar Certificado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="mb-4 text-green-600 font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Seleccionar Estudiante -->
                        <div class="mb-4">
                            <label for="student_id" class="block text-sm font-medium text-gray-700">
                                Estudiante
                            </label>
                            <select name="student_id" id="student_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">Selecciona un estudiante</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Título del Certificado
                            </label>
                            <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-lg shadow-sm" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Descripción (opcional)
                            </label>
                            <textarea name="description" id="description" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subir Archivo -->
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">
                                Archivo de Contenido (TXT o CSV)
                            </label>
                            <input type="file" name="file" id="file" class="w-full border-gray-300 rounded-lg shadow-sm">
                            @error('file')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón -->
                        <div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                Generar Certificado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
