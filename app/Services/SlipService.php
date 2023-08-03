<?php

namespace App\Services;

use App\Models\Slip;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SlipService{

    public function getAll()
    {
        return Slip::with(['doctor.user', 'patient', 'receptionist.user']);
    }

    public function filters($request, $slips)
    {
        isset($request->slip_id) && $request->slip_id != '' ? $slips->where('id', $request->slip_id) : '';
        isset($request->patient_id) && $request->patient_id != '' ? $slips->where('patient_id', $request->patient_id) : '';
        isset($request->doctor_id) && $request->doctor_id != '' ? $slips->where('doctor_id', $request->doctor_id) : '';
        isset($request->receptionist_id) && $request->receptionist_id != '' ? $slips->where('receptionist_id', $request->receptionist_id) : '';
        isset($request->type) && $request->type != '' ? $slips->where('type', $request->type) : '';
        isset($request->from_date) && $request->from_date != '' ? $slips->where('created_at', '>=' ,$request->from_date) : '';
        isset($request->to_date) && $request->to_date != '' ? $slips->where('created_at', '<=' ,$request->to_date) : '';
        
    

        return $slips;
    }
    
}
