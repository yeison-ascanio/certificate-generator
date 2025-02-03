<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'certificate_code',
        'title',
        'description',
        'issued_at',
        'file_path',
        'hash',
        'qr_code_path'
    ];

    protected $dates = ['issued_at'];

    public function user()
    {
        return $this->belongsTo(User::class); // Relación inversa con users
    }

    public function verifications()
    {
        return $this->hasMany(Verification::class); // Relación 1:N con verifications
    }
}
