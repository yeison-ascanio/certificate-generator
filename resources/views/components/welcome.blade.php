<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-bold text-gray-900">
        Bienvenido a la Plataforma de Certificación Digital
    </h1>

    <p class="mt-4 text-gray-600 leading-relaxed">
        Este sistema permite la generación, almacenamiento y verificación de certificados académicos con firma digital y códigos QR, asegurando autenticidad y accesibilidad.
    </p>
</div>
<div class="bg-gray-100 bg-opacity-50 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 lg:p-8">
    @if (Auth::user()->role == 'admin')
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m9 18V3" />
                </svg>
                <h2 class="ms-3 text-lg font-semibold text-gray-900">
                    Generar Certificado
                </h2>
            </div>
            <p class="mt-2 text-gray-600 text-sm">
                Crea un nuevo certificado digital, asigna a un estudiante y genera un documento seguro con firma digital y código QR.
            </p>
            <a href="{{ route('certificates.create') }}" class="mt-4 inline-flex items-center text-blue-600 font-semibold hover:underline">
                Generar ahora →
            </a>
        </div>
    @endif
@if (Auth::user()->role == 'student')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="size-6 stroke-green-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
            </svg>
            <h2 class="ms-3 text-lg font-semibold text-gray-900">
                Ver Mis Certificados
            </h2>
        </div>
        <p class="mt-2 text-gray-600 text-sm">
            Accede a tu historial de certificados digitales y descárgalos en cualquier momento.
        </p>
        <a href="{{ route('certificates.index') }}" class="mt-4 inline-flex items-center text-green-600 font-semibold hover:underline">
            Ver certificados →
        </a>
    </div>
@endif
</div>
