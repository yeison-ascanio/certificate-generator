<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt,csv',
            'student_id' => 'required|exists:users,id',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Leer el archivo TXT o CSV
                $fileContent = file_get_contents($request->file('file'));
                $student = User::findOrFail($request->student_id);

                // Generar hash único y código de verificación
                $certificateCode = $this->generateCertificateCode();
                $hash = hash('sha256', $fileContent);

                // Crear el código QR
                $qrPath = $this->generateQrCode($certificateCode);

                // Convertir imágenes a base64
                $logoBase64 = $this->convertToBase64(public_path('img/logo.png'));
                $qrBase64 = $this->convertToBase64($qrPath);

                // Generar PDF
                $pdfPath = $this->generatePdf([
                    'content' => $fileContent,
                    'student' => $student->name,
                    'title' => $request->title,
                    'description' => $request->description,
                    'code' => $certificateCode,
                    'hash' => $hash,
                    'logoBase64' => $logoBase64,
                    'qrBase64' => $qrBase64,
                ]);

                // Guardar en la base de datos
                $this->saveCertificate($student->id, $certificateCode, $request->title, $hash, $qrPath, $pdfPath);
            });

            return redirect()->route('certificates.create')->with('success', 'Certificado generado correctamente.');
        } catch (\Throwable $th) {
            return back()->withErrors(['error' => 'Ocurrió un error al generar el certificado.']);
        }
    }

    private function generateCertificateCode(): string
    {
        return 'CERT-' . uniqid();
    }

    private function generateQrCode(string $certificateCode): string
    {
        $qrCodeDirectory = public_path('qrcodes');
        if (!file_exists($qrCodeDirectory)) {
            mkdir($qrCodeDirectory, 0755, true);
        }

        $qrPath = $qrCodeDirectory . '/' . $certificateCode . '.png';
        $writer = new PngWriter();
        $qrCode = new QrCode(route('certificates.verify', ['code' => $certificateCode]));
        $writer->write($qrCode)->saveToFile($qrPath);

        return $qrPath;
    }

    private function convertToBase64(string $filePath): string
    {
        if (!file_exists($filePath)) {
            throw new \Exception("El archivo no existe: $filePath");
        }
        $mimeType = mime_content_type($filePath);
        return 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($filePath));
    }

    private function generatePdf(array $data): string
    {
        $certificateDirectory = public_path('certificates');
        if (!file_exists($certificateDirectory)) {
            mkdir($certificateDirectory, 0755, true);
        }

        $pdfPath = $certificateDirectory . '/' . $data['code'] . '.pdf';

        $pdf = Pdf::loadView('pdf.certificate', $data)
            ->setPaper('letter', 'portrait');
        $pdf->save($pdfPath);

        return $pdfPath;
    }

    private function saveCertificate(
        int $userId,
        string $certificateCode,
        string $title,
        string $hash,
        string $qrPath,
        string $pdfPath
    ): void {
        Certificate::create([
            'user_id' => $userId,
            'certificate_code' => $certificateCode,
            'title' => $title,
            'description' => 'Certificado generado desde archivo',
            'hash' => $hash,
            'qr_code_path' => str_replace(public_path(), '', $qrPath), // Ruta relativa
            'file_path' => str_replace(public_path(), '', $pdfPath), // Ruta relativa
        ]);
    }



    public function verify($code)
    {
        $certificate = Certificate::where('certificate_code', $code)->first();

        if (!$certificate) {
            return view('certificates.verify', [
                'status' => 'error',
                'message' => 'Certificado no encontrado'
            ]);
        }

        return view('certificates.verify', [
            'status' => 'success',
            'message' => 'Certificado válido',
            'data' => [
                'student' => $certificate->user->name,
                'title' => $certificate->title,
                'issued_at' => $certificate->issued_at,
                'hash' => $certificate->hash
            ]
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Auth::user()->certificates;
        return view('certificates.index', compact('certificates'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los usuarios con rol de "student"
        $students = User::where('role', 'student')->get();

        return view('certificates.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        //
    }
}
