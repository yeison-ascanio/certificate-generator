<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Certificado de Logro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .container {
            width: 95%; /* Reducir ancho total */
            padding: 15px; /* Reducir padding para que quede más compacto */
            border: 10px solid #4A90E2;
            border-radius: 15px;
            margin: 0 auto;
            max-width: 750px; /* Ajustar el máximo permitido */
            text-align: center;
        }

        .header {
            margin-bottom: 30px; /* Reducir espacio debajo del encabezado */
        }

        .header img {
            height: 70px; /* Ajustar tamaño del logo */
        }

        .title {
            font-size: 28px; /* Reducir tamaño de la fuente */
            font-weight: bold;
            color: #4A90E2;
            margin: 15px 0;
        }

        .subtitle {
            font-size: 18px; /* Reducir subtítulo */
            margin-bottom: 20px;
            color: #666;
        }

        .content {
            text-align: left;
            margin: 0 auto;
            font-size: 14px; /* Reducir fuente de contenido */
            line-height: 1.4; /* Reducir espaciado entre líneas */
        }

        .content p {
            margin: 8px 0; /* Reducir margen entre párrafos */
        }

        .qr-section {
            margin-top: 20px; /* Reducir espacio superior */
            text-align: center;
        }

        .qr-section img {
            width: 120px; /* Reducir tamaño del QR */
            height: 120px;
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 30px; /* Reducir espacio superior */
            font-size: 12px; /* Reducir tamaño del texto en el pie */
            color: #666;
        }

        .footer p {
            margin: 4px 0; /* Reducir espacio entre líneas del pie de página */
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <img src="{{ $logoBase64 }}" alt="Logo">
            <p class="title">Certificado de Logro</p>
            <p class="subtitle">Otorgado a:</p>
        </div>

        <!-- Información del Estudiante -->
        <div class="content">
            <p><strong>Nombre del Estudiante:</strong> {{ $student }}</p>
            <p><strong>Título del Certificado:</strong> {{ $title }}</p>
            @if (!empty($description))
                <p><strong>Descripción:</strong> {{ $description }}</p>
            @endif
            <p><strong>Contenido del Certificado:</strong> {{ $content }}</p>
            <p><strong>Código de Verificación:</strong> {{ $code }}</p>
            <p><strong>Hash de Seguridad:</strong> {{ $hash }}</p>
        </div>

        <!-- Sección del Código QR -->
        <div class="qr-section">
            <img src="{{ $qrBase64 }}" alt="Código QR">
            <p>Escanea el código QR para verificar la autenticidad de este certificado.</p>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>Certificado generado automáticamente por el sistema de certificación.</p>
            <p>Emitido el: {{ now()->format('d/m/Y') }}</p>
            <p>&copy; {{ now()->year }} Tu Institución. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
