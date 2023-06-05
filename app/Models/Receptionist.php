<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receptionist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'shift',
        'status',
        'description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($receptionist) {
            $receptionist->user->delete();
            foreach($receptionist->slips as $slip)
            {
                $slip->delete();
            }
            
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function slips()
    {
        return $this->hasMany(Slip::class);
    }
}
