<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_id', 'verified_at', 'ip_address', 'result'
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class); // Relación inversa con certificates
    }
}
