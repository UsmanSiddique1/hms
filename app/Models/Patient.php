<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mr_number',
        'name',
        'phone',
        'cnic',
        'age_years',
        'age_months',
        'age_weeks',
        'gender',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($patient) {
            foreach($patient->slips as $slip)
            {
                $slip->delete();
            }
            
        });
    }

    public function slips()
    {
        return $this->hasMany(Slip::class);
    }
}
