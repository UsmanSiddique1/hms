<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'speciality',
        'department_id',
        'price',
        'days',
        'from',
        'to'
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($doctor) {
    //         $doctor->user()->delete();
    //         foreach($doctor->slips as $slip)
    //         {
    //             $slip->delete();
    //         }
            
    //     });
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function slips()
    {
        return $this->hasMany(Slip::class);
    }
}
