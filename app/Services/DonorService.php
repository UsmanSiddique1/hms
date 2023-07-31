<?php

namespace App\Services;

use App\Models\Donor;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DonorService{

    public function updateOrCreate(Request $request)
    {
        Log::info("Create or Update Donner CNIC: ".$request->doner_cnic);
        $donor = Donor::updateOrCreate(
            [
                'cnic' => $request->donor_cnic
            ],
            [
                'name' => $request->donor_name,
                'phone' => $request->donor_phone,
                'address' => $request->donor_address,
                'age' => $request->donor_age,
                'gender' => $request->donor_gender,
                'S_O' => $request->get('donor_S_O'),
            ]
        );
        Log::info("Doner Details :".$donor);
        return $donor;
    }
}
