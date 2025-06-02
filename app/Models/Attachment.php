<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'license_id',
        'type',
        'file_path',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function attachable()
    {
        return $this->morphTo();
    }

}
