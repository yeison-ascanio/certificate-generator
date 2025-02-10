<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificación Digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 dark:text-white">

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-4xl text-center px-6">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">
                Plataforma de Certificación Digital
            </h1>
            <p class="mt-4 text-gray-600 dark:text-gray-300 text-lg">
                Genera, almacena y verifica certificados académicos de manera segura con firma digital y códigos QR.
            </p>

            <div class="mt-6 mb-6 flex justify-center space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                        Ir al Dashboard
                    </a>
                @else
                    <span class="me-1">
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">
                            Iniciar Sesión
                        </a>
                    </span>
                    <span class="ms-1">
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-gray-400 transition">
                            Registrarse
                        </a>
                    </span>
                @endauth
            </div>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Generar Certificados</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                    Administra y crea certificados digitales con firma electrónica y autenticación segura.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Acceso Estudiantil</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                    Los estudiantes pueden ver y descargar sus certificados en cualquier momento.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Validación en Línea</h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm">
                    Verifica certificados con código QR o autenticación de código único.
                </p>
            </div>
        </div>

        <footer class="mt-12 py-6 text-gray-600 dark:text-gray-400 text-sm">
            &copy; {{ date('Y') }} Plataforma de Certificación Digital. Todos los derechos reservados.
        </footer>
    </div>

</body>
</html>
