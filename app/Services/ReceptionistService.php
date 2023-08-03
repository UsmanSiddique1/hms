<?php

namespace App\Services;

use App\Models\Receptionist;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ReceptionistService{

    public function getAll()
    {
        return Receptionist::all();
    }

}
