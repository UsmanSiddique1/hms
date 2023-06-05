<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slip extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'receptionist_id',
        'patient_id',
        'department_id',
        'doctor_id',
        'bed_id',
        'bed_days',
        'type',
        'total_amount',
        'remaining_amount',
        'description',
        'slip_number'
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
        return $this->belongsTo(Department::class);
    }

    public function procedures()
    {
        return $this->hasMany(SlipProcedure::class);
    }

}
