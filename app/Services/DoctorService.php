<?php

namespace App\Services;

use App\Models\Doctor;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DoctorService{

    public function getAll()
    {
        return Doctor::with(['user', 'department']);
    }

}
