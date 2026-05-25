<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'address',
        'gender', 'date_of_birth', 'blood_group',
        'medical_notes', 'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // ── RELATIONSHIPS ─────────────────────────────────────
    // Appointments that belong to this patient
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    // ── ACCESSORS ─────────────────────────────────────────
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth
            ? $this->date_of_birth->age
            : null;
    }

    public function getInitialAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1));
    }
}