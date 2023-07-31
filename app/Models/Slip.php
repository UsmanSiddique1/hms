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
        'donor_id',
        'department_id',
        'doctor_id',
        'bed_id',
        'bed_days',
        'type',
        'total_amount',
        'grand_total',
        'remaining_amount',
        'discount',
        'description',
        'slip_number',
        'doctor_type',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class)->withTrashed();
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)->withTrashed();
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class)->withTrashed();
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class)->withTrashed();
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class)->withTrashed();
    }

    // public function procedures()
    // {
    //     return $this->hasMany(SlipProcedure::class);
    // }

    public function procedures()
    {
        return $this->belongsToMany(Procedure::class, 'slip_procedures', 'slip_id', 'procedure_id')->withPivot('price')->withTrashed();
    }

    public function getSlipNumberAttribute($value)
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

}
