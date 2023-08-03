<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PatientService{

    public function getAll()
    {
        return Patient::all();
    }

}
