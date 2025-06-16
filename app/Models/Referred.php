<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referred extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone1',
        'phone2',
        'referred_by_id',
        'country',
    ];

    /**
     * El referido que lo recomendó (autorelación).
     */
    public function referredBy()
    {
        return $this->belongsTo(Referred::class, 'referred_by_id');
    }

    /**
     * Los referidos que este referido ha recomendado.
     */
    public function referrals()
    {
        return $this->hasMany(Referred::class, 'referred_by_id');
    }

    /**
     * Obtener el nombre completo como atributo virtual.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
