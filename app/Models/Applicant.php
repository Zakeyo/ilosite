<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
    'first_name', 'last_name', 'id_number', 'birth_date', 'email',
    'country_of_origin', 'address_1', 'address_2', 'phone_1', 'phone_2',
    'passport_number', 'height_cm', 'eye_color', 'blood_type', 'has_local_license',
    'birth_date' => 'date',
    ];

    public function license()
    {
        return $this->hasOne(License::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
