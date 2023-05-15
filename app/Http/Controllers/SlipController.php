<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceCount;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Department;
use App\Models\Bed;
use App\Models\Slip;

class SlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slips = Slip::all();
        return view('slips.index', compact('slips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ref_count = ReferenceCount::where('type', 'mr')->first();
        $new_mr = $ref_count->count + 1;        

        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments = Department::all();
        $beds = Bed::all();
        $procedures = Procedure::all();
        return view('slips.create', compact('new_mr','patients','doctors','departments','beds','procedures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'mr_number' => 'required',
            'type' => 'required'
        ]);

        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/patients'), $filename);
            $imageUrl = 'public/uploads/patients'.$filename;
        }
        else{
            $imageUrl = '';
        }

        $patient = Patient::firstOrCreate(['mr_number'=> $request->mr_number],
        [
            'mr_number' => $request->mr_number,            
            'name' => $request->name,
            'phone' => $request->phone,
            'age' => $request->age,
            'gender' => $request->gender,
            'image' => $imageUrl,
        ]);

        $slip = Slip::create([
            'patient_id' => $patient->id,
            'department_id' => $request->department,
            'receptionist_id' => 1,
            'bed_id' => $request->bed,
            'doctor_id' => $request->doctor,
            'type' => $request->type,
            'total_amount' => $request->total_amount,
            'remaining_amount' => 0

        ]);

        $ref_count = ReferenceCount::where('type', 'mr')->first();
        $ref_count->count = $ref_count->count + 1;
        $ref_count->update();


        return redirect('/slip/'.$slip->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function view(Slip $slip)
    {
        return view('slips.view', compact('slip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
