<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SlipProcedure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slip_id',
        'procedure_id',
        'price'
    ];

    public function slip()
    {
        return $this->belongsTo(Slip::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
