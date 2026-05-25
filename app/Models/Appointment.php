<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'name', 'phone', 'email','address',
        'service', 'date', 'time',
        'notes', 'status'
    ];
}