<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'W_O',
        'S_O',
        'D_O',
        'phone',
        'address',
        'cnic',
        'gender',
        'age'
    ];


    public function slips()
    {
        return $this->hasMany(Slip::class);
    }
    
    

}
