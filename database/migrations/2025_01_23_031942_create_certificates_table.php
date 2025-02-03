<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con estudiantes
            $table->string('certificate_code')->unique(); // Código único para verificación
            $table->string('title'); // Título del PDF
            $table->text('description')->nullable();
            $table->string('hash'); // Hash de verificación
            $table->string('qr_code_path'); // Ruta del QR
            $table->string('file_path'); // Ruta del archivo PDF generado
            $table->timestamp('issued_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
