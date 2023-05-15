<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;
    protected $fillable = [
        'receptionist_id',
        'patient_id',
        'department_id',
        'doctor_id',
        'type',
        'total_amount',
        'remaining_amount',
        'description'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }

}
