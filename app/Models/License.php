<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'license_type',
        'duration',
        'categories',
        'transaction_number',
        'issued_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'categories' => 'array',
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
