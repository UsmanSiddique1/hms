<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'mr_number',
        'name',
        'phone',
        'age_years',
        'age_months',
        'age_weeks',
        'gender',
        'image'
    ];
}
