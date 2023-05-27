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
use App\Models\SlipProcedure;
use App\Models\Receptionist;
use Auth;

use Illuminate\Support\Facades\DB;


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
        $ref_mr_count = ReferenceCount::where('type', 'mr')->first();
        $new_mr = $ref_mr_count->count + 1;         
        $ref_slip_count = ReferenceCount::where('type', 'slip')->first();
        $new_slip = $ref_slip_count->count + 1; 

        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments = Department::all();
        $beds = Bed::all();
        $procedures = Procedure::all();
        $receptionists = Receptionist::all();
        return view('slips.create', compact('new_mr','patients','doctors','departments','beds','procedures', 'new_slip','receptionists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        try {

            DB::beginTransaction();

            $request->validate([
                'mr_number' => 'required',
                'type' => 'required'
            ]);
            
            $imageUrl = 'dummy-image.jpg';

            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/patients'), $filename);
                $imageUrl = 'public/uploads/patients'.$filename;
            }

            

            $patient = Patient::where('mr_number', $request->mr_number)->first();
            
            if(!$patient)
            {
                $patient = Patient::create([
                    'mr_number' => $request->mr_number,            
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'age_years' => $request->age_years,
                    'age_months' => $request->age_months,
                    'age_weeks' => $request->age_weeks,
                    'gender' => $request->gender,
                    'image' => $imageUrl,
                ]);
            }      
            
           
            $slip_number_count = ReferenceCount::where('type', 'slip')->first();
            $slip_number_count->count = $slip_number_count->count + 1;
            $slip_number_count->update();
            
            $slip_number = 'Slip#'. $slip_number_count->count;
            $receptionist_id = $request->receptionist_id != '' ? $request->receptionist_id : Auth::user()->receptionist->id;
            $slip = Slip::create([
                'slip_number' => $slip_number,
                'patient_id' => $patient->id,
                'department_id' => $request->department,
                'receptionist_id' => $receptionist_id,
                'bed_id' => $request->bed,
                'doctor_id' => $request->doctor,
                'type' => $request->type,
                'total_amount' => $request->total_amount,
                'remaining_amount' => 0    
            ]);

            if(isset($request->procedure) && count($request->procedure) > 0)
            {
                foreach($request->procedure as $item => $v)
                {
                    $procedure = Procedure::find($request->procedure[$item]);
                    SlipProcedure::create([
                        'slip_id' => $slip->id,
                        'procedure_id' => $procedure->id,
                        'price' => $procedure->price
                    ]);
                }
            }
    
            $ref_count = ReferenceCount::where('type', 'mr')->first();
            $ref_count->count = $ref_count->count + 1;
            $ref_count->update();

            DB::commit();


        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with('error', $e->getFile(). "Line:" . $e->getLine().  $e->getMessage());
            
        }      

        return redirect('/slips/'.$slip->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slip $slip)
    {
        return view('slips.view', compact('slip'));

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
