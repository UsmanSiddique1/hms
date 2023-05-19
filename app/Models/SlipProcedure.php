<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipProcedure extends Model
{
    use HasFactory;

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
