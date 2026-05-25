<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'specialization', 'phone', 'email',
        'address', 'qualification', 'experience_years',
        'bio', 'photo', 'status'
    ];
}